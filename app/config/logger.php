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
    'defaultFilename' => env('LOGGER_DEFAULT_FILENAME'),
    'format'          => env('LOGGER_FORMAT'),
    'level'           => env('LOGGER_LEVEL'),
];
