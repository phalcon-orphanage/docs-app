<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
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
