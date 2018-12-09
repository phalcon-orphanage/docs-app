<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\Markdown;

use ParsedownExtra;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;

/**
 * Docs\Providers\Markdown\ServiceProvider
 *
 * @package Docs\Providers\Markdown
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
        $container->setShared('parsedown', ParsedownExtra::class);
    }
}
