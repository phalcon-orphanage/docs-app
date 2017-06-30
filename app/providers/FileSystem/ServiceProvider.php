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
    public function register(DiInterface $di)
    {
        $di->set(
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
