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

namespace Docs\Providers\Assets;

use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use function Docs\Functions\container;
use function Docs\Functions\assets_uri;
use function Docs\Functions\environment;

/**
 * Docs\Providers\Assets\ServiceProvider
 *
 * @package Docs\Providers\Assets
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $assets = $di->getShared('assets');
        $assets->collection("header_js");

        if (environment('development')) {
            $version = time();
        } else {
            $version = container('config')->get('app')->get('version', '9999');
        }

        $assets
            ->collection('header_css')
            ->addCss('https://fonts.googleapis.com/css?family=Lato', false)
            ->addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', false)
            ->addCss('https://cdn.jsdelivr.net/highlight.js/9.9.0/styles/darcula.min.css', false)
            ->addCss(assets_uri('css/docs.css', $version));

        $assets
            ->collection('footer_js')
            ->addJs('https://code.jquery.com/jquery-3.1.1.min.js', false)
            ->addJs('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', false)
            ->addJs('https://cdn.jsdelivr.net/highlight.js/9.9.0/highlight.min.js', false);
    }
}
