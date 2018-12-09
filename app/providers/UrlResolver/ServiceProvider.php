<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\UrlResolver;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Phalcon\Mvc\Url;
use function Docs\Functions\config;

/**
 * Docs\Providers\UrlResolver\ServiceProvider
 *
 * @package Docs\Providers\UrlResolver
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
            'url',
            function () {
                $url = new Url();

                $url->setBaseUri(config('app.baseUri', '/'));
                $url->setStaticBaseUri(config('app.staticUrl', '/'));

                return $url;
            }
        );
    }
}
