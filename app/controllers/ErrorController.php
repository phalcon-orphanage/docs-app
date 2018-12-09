<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
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
