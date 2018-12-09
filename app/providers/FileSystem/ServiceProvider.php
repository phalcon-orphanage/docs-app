<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\FileSystem;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use function Docs\Functions\app_path;

/**
 * Docs\Providers\FileSystem\ServiceProvider
 *
 * @package Docs\Providers\FileSystem
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
        $container->set(
            'filesystem',
            function ($root = null) {
                if ($root === null) {
                    $root = app_path();
                }

                return new Filesystem(new Local($root));
            }
        );
    }
}
