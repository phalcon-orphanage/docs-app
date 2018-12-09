<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\Assets;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use function Docs\Functions\assets_uri;
use function Docs\Functions\config;

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

        $debug = config('app.debug');
        if (true === $debug) {
            $assetTag = time();
        } else {
            $assetTag = config('app.assetTag', time());
        }

        $highlightVersion = config('highlight.version', '9.11.0');
        $supportedJs      = array_map(
            function ($lang) {
                return "languages/{$lang}.min.js";
            },
            config('highlight.js')->toArray()
        );
        $supportedJs      = implode('+', ['highlight.min.js'] + $supportedJs);

        /* TODO(o2)
         * $jsCdn  = "https://cdn.jsdelivr.net/g/jquery@3.1.1,"
                . "bootstrap@3.3.7,"
                . "highlight.js@{$highlightVersion}({$supportedJs})";

        $assets
            ->collection('header_css')
            ->addCss(assets_uri('css/docs.css', $version));

        $assets
            ->collection('footer_js')
            ->addJs($jsCdn, false)
            ->addJs(assets_uri('js/edit_button.js', $version));
        */


        $cssCdn = "https://cdn.jsdelivr.net/g/font-lato@2.0(Lato/Lato-Black.css),"
            . "bootstrap@3.3.7(css/bootstrap.min.css),"
            . "highlight.js@{$highlightVersion}(styles/monokai-sublime.min.css)";
        $jsCdn  = "https://cdn.jsdelivr.net/g/jquery@3.1.1,"
            . "bootstrap@3.3.7,"
            . "highlight.js@{$highlightVersion}({$supportedJs})";

        $assets
            ->collection('header_css')
            // TODO(o2)
            // ->addCss($cssCdn, false)
            ->addCss(assets_uri('js/highlight/styles/googlecode.css', $assetTag))
            ->addCss(assets_uri('css/style.css', $assetTag));

        $assets
            ->collection('footer_js')
            // // TODO(o2)
            // ->addJs($jsCdn, false);
            ->addJs(assets_uri('js/main.min.js', $assetTag))
            ->addJs(assets_uri('js/highlight/highlight.pack.js', $assetTag));
    }
}
