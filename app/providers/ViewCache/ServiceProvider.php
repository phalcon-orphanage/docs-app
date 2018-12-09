<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\ViewCache;

use Phalcon\Cache\Frontend\Output;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use function Docs\Functions\app_path;
use function Docs\Functions\config;

/**
 * Docs\Providers\ViewCache\ServiceProvider
 *
 * @package Docs\Providers\ViewCache
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * Note: The frontend must always be Phalcon\Cache\Frontend\Output and the
     * service 'viewCache' must be registered as always open (not shared) in
     * the services container (DI).
     *
     * @param DiInterface $container
     */
    public function register(DiInterface $container)
    {
        $container->set(
            'viewCache',
            function () {
                $driver  = config('cache.viewDriver', 'File');
                $adapter = '\Phalcon\Cache\Backend\\' . ucfirst($driver);

                return new $adapter(
                    new Output(['lifetime' => config('cache.lifetime', 3600)]),
                    [
                        'cacheDir' => app_path('storage/cache/view/'),
                    ]
                );
            }
        );
    }
}
