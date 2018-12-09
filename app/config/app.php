<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

use function Docs\Functions\app_path;
use function Docs\Functions\env;

$versions = file(app_path('VERSIONS'), FILE_IGNORE_NEW_LINES);
end($versions);
$version  = current($versions);
$debug    = env('APP_DEBUG', false);
$assetTag = (true === $debug) ? time() : env('ASSET_TAG', time());

return [
    'assetTag'        => $assetTag,
    'version'         => $version,
    'timezone'        => env('APP_TIMEZONE', 'UTC'),
    'debug'           => $debug,
    'env'             => env('APP_ENV'),
    'url'             => env('APP_URL'),
    'name'            => env('APP_NAME'),
    'project'         => env('APP_PROJECT'),
    'description'     => env('APP_DESCRIPTION'),
    'descriptionLong' => env('APP_DESCRIPTION_LONG', 'Official Phalcon Documentation'),
    'keywords'        => env('APP_KEYWORDS'),
    'repo'            => env('APP_REPO'),
    'docs'            => env('APP_DOCS'),
    'baseUri'         => env('APP_BASE_URI'),
    'staticUrl'       => env('APP_STATIC_URL'),
    'lang'            => env('APP_LANG'),
    'supportEmail'    => env('APP_SUPPORT_EMAIL'),
];
