<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 20111-2017 Phalcon Team (https://phalconphp.com)         |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/

namespace Docs\Exception\Handler;

use Phalcon\Config;
use Whoops\Handler\Handler;
use function Docs\Functions\container;

/**
 * Docs\Exception\Handler\ErrorPageHandler
 *
 * @package Docs\Exception\Handler
 */
class ErrorPageHandler extends Handler
{
    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function handle()
    {
        $exception = $this->getException();

        if (!$exception instanceof \Exception && !$exception instanceof \Throwable) {
            return Handler::DONE;
        }

        if (!container()->has('view') ||
            !container()->has('dispatcher') ||
            !container()->has('response') ||
            !container('config')->get('error') instanceof Config
        ) {
            return Handler::DONE;
        }

        $config = container('config')->get('error');

        switch ($exception->getCode()) {
            case E_WARNING:
            case E_NOTICE:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
            case E_USER_WARNING:
            case E_USER_NOTICE:
            case E_STRICT:
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
            case E_ALL:
                return Handler::DONE;
        }

        $this->renderErrorPage();

        return Handler::QUIT;
    }

    private function renderErrorPage()
    {
        $config     = container('config')->error;
        $dispatcher = container('dispatcher');
        $view       = container('view');
        $response   = container('response');

        $dispatcher->setControllerName($config->controller);
        $dispatcher->setActionName($config->action);

        $view->start();
        $dispatcher->dispatch();
        $view->render($config->controller, $config->action, $dispatcher->getParams());
        $view->finish();

        $response->setContent($view->getContent())->send();
    }
}
