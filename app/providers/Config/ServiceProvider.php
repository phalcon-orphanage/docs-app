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

namespace Docs\Providers\Config;

use Docs\Config\Factory;
use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Docs\Providers\Config\ServiceProvider
 *
 * @package Docs\Providers\Config
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Config files.
     * @var array
     */
    protected $configs = [
        'app',
        'cache',
        'google',
        'languages',
        'logger',
        // @todo Move to the route service provider
        'routes',
    ];

    public function register(DiInterface $di)
    {
        $configs = $this->configs;

        $di->setShared(
            'config',
            function () use ($configs) {
                return Factory::create($configs);
            }
        );
    }
}
