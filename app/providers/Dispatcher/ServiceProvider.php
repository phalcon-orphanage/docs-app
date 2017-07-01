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

namespace Docs\Providers\Dispatcher;

use Phalcon\Cli\Dispatcher;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;

/**
 * Docs\Providers\Dispatcher\ServiceProvider
 *
 * @package Docs\Providers\Dispatcher
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
        // @todo
        if ($container->get('bootstrap')->getMode() !== 'cli') {
            return;
        }

        $container->setShared(
            'dispatcher',
            function () {
                $dispatcher = new Dispatcher();
                $dispatcher->setDefaultNamespace('Docs\Cli\Tasks');

                return $dispatcher;
            }
        );
    }
}
