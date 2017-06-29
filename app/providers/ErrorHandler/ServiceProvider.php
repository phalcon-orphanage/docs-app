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

namespace Docs\Providers\ErrorHandler;

use Whoops\Run;
use Phalcon\DiInterface;
use InvalidArgumentException;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;
use Phalcon\Di\ServiceProviderInterface;
use Docs\Exception\Handler\LoggerHandler;
use Docs\Exception\Handler\ErrorPageHandler;
use function Docs\Functions\env;
use function Docs\Functions\container;

/**
 * Docs\Providers\ErrorHandler\ServiceProvider
 *
 * @package Docs\Providers\ErrorHandler
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $di->setShared('errorHandler::loggerHandler', LoggerHandler::class);
        $di->setShared('errorHandler::prettyPageHandler', PrettyPageHandler::class);
        $di->setShared('errorHandler::errorPageHandler', ErrorPageHandler::class);

        $di->setShared(
            'errorHandler::jsonResponseHandler',
            function () {
                $handler = new JsonResponseHandler();
                $handler->setJsonApi(true);

                return $handler;
            }
        );

        $di->setShared(
            'errorHandler',
            function () {
                $run  = new Run();
                $run->pushHandler(container('errorHandler::loggerHandler'));

                $mode = container('bootstrap')->getMode();

                switch ($mode) {
                    case 'normal':
                        if (env('APP_DEBUG', false)) {
                            $run->pushHandler(container('errorHandler::prettyPageHandler'));
                        } else {
                            $run->pushHandler(container('errorHandler::errorPageHandler'));
                        }
                        break;
                    case 'cli':
                        // @todo
                        break;
                    case 'api':
                        throw new InvalidArgumentException(
                            'Not implemented yet.'
                        );
                        // @todo
                        // $run->pushHandler(container('errorHandler::jsonResponseHandler'));
                        break;
                    default:
                        throw new InvalidArgumentException(
                            sprintf(
                                'Invalid application mode. Expected either "normal" or "cli" or "api". Got "%s".',
                                is_scalar($mode) ? $mode : var_export($mode, true)
                            )
                        );
                }

                return $run;
            }
        );

        container('errorHandler')->register();
    }
}
