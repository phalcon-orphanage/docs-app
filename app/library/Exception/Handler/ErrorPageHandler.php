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

use Whoops\Handler\Handler;
use function Docs\Functions\config;
use function Docs\Functions\container;

/**
 * Docs\Exception\Handler\ErrorPageHandler
 *
 * @package Docs\Exception\Handler
 */
class ErrorPageHandler extends Handler
{
    private $handleCodes = [
        E_WARNING         => true,
        E_NOTICE          => true,
        E_CORE_WARNING    => true,
        E_COMPILE_WARNING => true,
        E_USER_WARNING    => true,
        E_USER_NOTICE     => true,
        E_STRICT          => true,
        E_DEPRECATED      => true,
        E_USER_DEPRECATED => true,
        E_ALL             => true,
    ];

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

        if (!$this->isItPossibleToHandle()) {
            return Handler::DONE;
        }

        if ($this->shouldWeSkipCurrentCode($exception->getCode())) {
            return Handler::DONE;
        }

        $this->renderErrorPage();

        return Handler::QUIT;
    }

    private function shouldWeSkipCurrentCode($code) : bool
    {
        return isset($this->handleCodes[$code]);
    }

    private function isItPossibleToHandle() : bool
    {
        return container()->has('viewSimple') &&
            container()->has('dispatcher') &&
            container()->has('response');
    }

    private function renderErrorPage()
    {
        $dispatcher = container('dispatcher');
        $view       = container('viewSimple');
        $response   = container('response');

        $controller = config('error.controller', 'error');
        $defaultAction = config('error.action', 'show500');

        switch ($this->getException()->getCode()) {
            case 404:
                $action = 'show404';
                break;
            default:
                $action = $defaultAction;
        }

        /** @var \Phalcon\Mvc\Dispatcher $dispatcher */
        $dispatcher->setNamespaceName('Docs\Controllers');
        $dispatcher->setControllerName($controller);
        $dispatcher->setActionName($action);
        $dispatcher->dispatch();

        $content = $view->render("$controller/$action", $dispatcher->getParams());

        $response->setContent($content)->send();
    }
}
