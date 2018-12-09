<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\EventsManager;

use Docs\Events\NewRelicTransactionListener;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Phalcon\Events\Manager;

/**
 * Docs\Providers\EventsManager\ServiceProvider
 *
 * @package Docs\Providers\EventsManager
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
            'eventsManager',
            function () {
                $em = new Manager();
                $em->enablePriorities(true);

                $em->attach('micro:afterExecuteRoute', new NewRelicTransactionListener());

                return $em;
            }
        );
    }
}
