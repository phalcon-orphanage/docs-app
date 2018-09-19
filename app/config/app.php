<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://phalconphp.com)          |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
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
