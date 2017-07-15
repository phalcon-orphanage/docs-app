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

namespace Docs\Providers\CacheData;

use Phalcon\DiInterface;
use Phalcon\Cache\Frontend\Data;
use Phalcon\Di\ServiceProviderInterface;
use function Docs\Functions\app_path;
use function Docs\Functions\config;

/**
 * Docs\Providers\CacheData\ServiceProvider
 *
 * @package Docs\Providers\CacheData
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
        $container->setShared(
            'cacheData',
            function () {
                $lifetime = config('cache.lifetime', 3600);
                $driver   = config('cache.driver', 'file');

                $frontEnd = new Data(['lifetime' => $lifetime]);
                $backEnd  = ['cacheDir' => app_path('storage/cache/data/')];
                $adapter  = sprintf('\Phalcon\Cache\Backend\%s', ucfirst($driver));

                return new $adapter($frontEnd, $backEnd);
            }
        );
    }
}
