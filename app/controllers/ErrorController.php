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

namespace Docs\Controllers;

use function Docs\Functions\config;

/**
 * Docs\Controllers\ErrorController
 *
 * @package Docs\Controllers
 */
class ErrorController extends BaseController
{
    public function show500Action()
    {
        $this->response->setStatusCode(500);

        $this->tag->prependTitle('Internal Error');

        $version = $this->getVersion();

        // TODO: It seems we can try detect the requested language
        $language = 'en';

        $this->viewSimple->setVars([
            'sidebar'  => $this->getDocument('en', $version, 'sidebar'),
            'language' => 'en',
            'article'  => '',
            'support'  => config('app.supportEmail', 'support@phalconphp.com'),
            'version'  => $version,
            'page'     => '',
            'homeArray'=> $this->getWordsArray($language, $version),
        ]);
    }

    public function show404Action()
    {
        $this->response->setStatusCode(404);

        $this->tag->prependTitle('Not Found');

        $version = $this->getVersion();

        // TODO: It seems we can try detect the requested language
        $language = 'en';

        $this->viewSimple->setVars([
            'sidebar'  => $this->getDocument('en', $version, 'sidebar'),
            'language' => 'en',
            'article'  => '',
            'support'  => config('app.supportEmail', 'support@phalconphp.com'),
            'version'  => $version,
            'page'     => '',
            'homeArray'=> $this->getWordsArray($language, $version),
        ]);
    }
}
