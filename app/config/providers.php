<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

return [
    // Application Service Providers
    Docs\Providers\Config\ServiceProvider::class,
    Docs\Providers\FileSystem\ServiceProvider::class,
    Docs\Providers\UrlResolver\ServiceProvider::class,
    Docs\Providers\Routing\ServiceProvider::class,
    Docs\Providers\Logger\ServiceProvider::class,
    Docs\Providers\ViewCache\ServiceProvider::class,
    Docs\Providers\VoltTemplate\ServiceProvider::class,
    Docs\Providers\View\ServiceProvider::class,
    Docs\Providers\CacheData\ServiceProvider::class,
    Docs\Providers\Markdown\ServiceProvider::class,
    Docs\Providers\Assets\ServiceProvider::class,
    Docs\Providers\Dispatcher\ServiceProvider::class,
    Docs\Providers\Tags\ServiceProvider::class,

    // Third Party Providers
    // ...
];
