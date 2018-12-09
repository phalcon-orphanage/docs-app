<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

use Docs\Controllers\DocsController;

return [
    DocsController::class => [
        'methods' => [
            'get'  => [
                '/'                         => 'redirectAction',
                '/{l:[a-z]{2}}'             => 'mainAction',
                '/{l:[a-z]{2}}/{v}'         => 'mainAction',
                '/{l:[a-z]{2}}/{v}/{p}'     => 'mainAction',
                '/{l:[a-z]{2}}/{v}/api/{p}' => 'mainAction',
                '/search'                   => 'searchAction',
            ],

            // This is exactly the same execution as GET, but the Response has no body
            'head' => [
                '/'                         => 'redirectAction',
                '/{l:[a-z]{2}}'             => 'mainAction',
                '/{l:[a-z]{2}}/{v}'         => 'mainAction',
                '/{l:[a-z]{2}}/{v}/{p}'     => 'mainAction',
                '/{l:[a-z]{2}}/{v}/api/{p}' => 'mainAction',
            ],
        ],
    ],
];
