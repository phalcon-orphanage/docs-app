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

namespace Docs\Providers\Assets;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use function Docs\Functions\assets_uri;
use function Docs\Functions\config;
use function Docs\Functions\environment;

/**
 * Docs\Providers\Assets\ServiceProvider
 *
 * @package Docs\Providers\Assets
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * @param DiInterface $container
     */
    public function register(DiInterface $container)
    {
        $assets = $container->getShared('assets');
        $assets->collection("header_js");

        if (environment('development')) {
            $version = time();
        } else {
            $version = config('app.version', '9999');
        }

        $highlightVersion = config('highlight.version', '9.11.0');
        $supportedJs      = array_map(
            function ($lang) {
                return "languages/{$lang}.min.js";
            },
            config('highlight.js')->toArray()
        );
        $supportedJs      = implode('+', ['highlight.min.js'] + $supportedJs);

        $cssCdn = "https://cdn.jsdelivr.net/g/font-lato@2.0(Lato/Lato-Black.css),"
                . "bootstrap@3.3.7(css/bootstrap.min.css),"
                . "highlight.js@{$highlightVersion}(styles/monokai-sublime.min.css)";
        $jsCdn  = "https://cdn.jsdelivr.net/g/jquery@3.1.1,"
                . "bootstrap@3.3.7,"
                . "highlight.js@{$highlightVersion}({$supportedJs})";

        $assets
            ->collection('header_css')
            ->addCss($cssCdn, false)
            ->addCss(assets_uri('css/docs.css', $version));

        $assets
            ->collection('footer_js')
            ->addJs($jsCdn, false)
            ->addJs(assets_uri('js/edit_button.js', $version));
    }
}
