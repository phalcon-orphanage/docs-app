<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\Routing;

use Docs\Exception\HttpException;
use Phalcon\Cli\Router;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Phalcon\Mvc\Micro\Collection;
use function Docs\Functions\config;
use function Docs\Functions\container;

/**
 * Docs\Providers\Routing\ServiceProvider
 *
 * @package Docs\Providers\Routing
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
        $mode = container('bootstrap')->getMode();

        switch ($mode) {
            case 'normal':
                $collections = config('routes')->toArray();
                $app         = container('app');

                foreach ($collections as $handler => $routes) {
                    $collection = new Collection();

                    $collection->setHandler($handler, true);

                    if (!empty($routes['prefix'])) {
                        $collection->setPrefix($routes['prefix']);
                    }

                    foreach ($routes['methods'] as $verb => $methods) {
                        foreach ($methods as $endpoint => $action) {
                            $collection->$verb($endpoint, $action);
                        }
                    }

                    $app->mount($collection);
                }

                $app->notFound(function () {
                    // todo: custom newrelic error handler
                    throw new HttpException('Not Found', 404);
                });

                break;
            case 'cli':
                container()->setShared('router', Router::class);
        }
    }
}
