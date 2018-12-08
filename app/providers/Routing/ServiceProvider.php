<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://phalconphp.com)          |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
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
