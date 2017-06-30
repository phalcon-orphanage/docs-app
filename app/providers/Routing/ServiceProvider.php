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

namespace Docs\Providers\Routing;

use Phalcon\Cli\Router;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Phalcon\Mvc\Micro\Collection;

/**
 * Docs\Providers\Routing\ServiceProvider
 *
 * @package Docs\Providers\Routing
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $mode = $di->getShared('bootstrap')->getMode();

        switch ($mode) {
            case 'normal':
                $collection = new Collection();
                $routes     = $di->getShared('config')->routes->toArray();

                $collection->setHandler($routes['class'], true);
                if (!empty($routes['prefix'])) {
                    $collection->setPrefix($routes['prefix']);
                }

                foreach ($routes['methods'] as $verb => $methods) {
                    foreach ($methods as $endpoint => $action) {
                        $collection->$verb($endpoint, $action);
                    }
                }

                $di->getShared('app')->mount($collection);
                break;
            case 'cli':
                $di->setShared('router', Router::class);
        }
    }
}
