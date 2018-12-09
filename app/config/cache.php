<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

use function Docs\Functions\env;

return [
    'driver'     => env('CACHE_DRIVER'),
    'viewDriver' => env('VIEW_CACHE_DRIVER'),
    'prefix'     => env('CACHE_PREFIX'),
    'lifetime'   => env('CACHE_LIFETIME'),
];
