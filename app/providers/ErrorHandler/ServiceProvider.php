<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\ErrorHandler;

use Docs\Exception\Handler\ErrorPageHandler;
use Docs\Exception\Handler\LoggerHandler;
use InvalidArgumentException;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use function Docs\Functions\container;
use function Docs\Functions\env;

/**
 * Docs\Providers\ErrorHandler\ServiceProvider
 *
 * @package Docs\Providers\ErrorHandler
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * @param DiInterface $container
     */
    public function register(DiInterface $container)
    {
        $container->setShared('errorHandler::loggerHandler', LoggerHandler::class);
        $container->setShared('errorHandler::prettyPageHandler', PrettyPageHandler::class);
        $container->setShared('errorHandler::errorPageHandler', ErrorPageHandler::class);

        $container->setShared(
            'errorHandler',
            function () {
                $run = new Run();

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
                    default:
                        throw new InvalidArgumentException(
                            sprintf(
                                'Invalid application mode. Expected either "normal" or "cli". Got "%s".',
                                is_scalar($mode) ? $mode : var_export($mode, true)
                            )
                        );
                }

                $run->pushHandler(container('errorHandler::loggerHandler'));

                return $run;
            }
        );

        container('errorHandler')->register();
    }
}
