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
    'class'   => Docs\Controllers\DocsController::class,
    'methods' => [
        'get' => [
            '/'                         => 'redirectAction',
            '/{l:[a-z]{2}}'             => 'mainAction',
            '/{l:[a-z]{2}}/{v}'         => 'mainAction',
            '/{l:[a-z]{2}}/{v}/{p}'     => 'mainAction',
            '/{l:[a-z]{2}}/{v}/api/{p}' => 'mainAction',
            '/sitemap.xml'              => 'sitemapAction',
        ],

        // This is exactly the same execution as GET, but the Response has no body
        'head' => [
            '/'                         => 'redirectAction',
            '/{l:[a-z]{2}}'             => 'mainAction',
            '/{l:[a-z]{2}}/{v}'         => 'mainAction',
            '/{l:[a-z]{2}}/{v}/{p}'     => 'mainAction',
            '/{l:[a-z]{2}}/{v}/api/{p}' => 'mainAction',
            '/sitemap.xml'              => 'sitemapAction',
        ],
    ],
];
