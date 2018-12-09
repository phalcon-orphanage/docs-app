<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\CacheData;

use Phalcon\Cache\Frontend\Data;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
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
