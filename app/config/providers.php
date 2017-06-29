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

    // Third Party Providers
    // ...
];
