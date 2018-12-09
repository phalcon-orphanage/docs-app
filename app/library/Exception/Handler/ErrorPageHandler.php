<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Exception\Handler;

use Whoops\Handler\Handler;
use Phalcon\Http\Response;
use function Docs\Functions\config;
use function Docs\Functions\container;

/**
 * Docs\Exception\Handler\ErrorPageHandler
 *
 * @package Docs\Exception\Handler
 */
class ErrorPageHandler extends Handler
{
    private $unHandleCodes = [
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

    private function isItPossibleToHandle(): bool
    {
        return container()->has('viewSimple') &&
            container()->has('dispatcher') &&
            container()->has('response');
    }

    private function shouldWeSkipCurrentCode($code): bool
    {
        return isset($this->unHandleCodes[$code]);
    }

    private function renderErrorPage()
    {
        $dispatcher = container('dispatcher');
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

        $this->safeRenderError("$controller/$action", $dispatcher->getParams());
    }

    private function safeRenderError($viewName, $viewParams)
    {
        if (container()->has('response')) {
            $response = container('response');
        } else {
            $response = new Response();
        }

        $try = 0;
        $view = container('viewSimple');
        do {
            /**
             * An error like:
             *      Phalcon\Mvc\View\Engine\Volt\Compiler::compile(): mstat failed for ...
             * still may occur
             */
            try {
                $content = $view->render($viewName, $viewParams);
                $response->setContent($content)->send();
                break;
            } catch (\Exception $e) {
                $try++;
                usleep($try * 500000);
                continue;
            } catch (\Throwable $e) {
                $try++;
                usleep($try * 500000);
                continue;
            }
        } while ($try < 10);


        if (false === $response->isSent()) {
            header("Location: " . config('app.url', 'https://docs.phalconphp.com'));

            /**
             * Why you should use die():
             * @link http://thedailywtf.com/Articles/WellIntentioned-Destruction.aspx
             */
            die();
        }
    }
}
