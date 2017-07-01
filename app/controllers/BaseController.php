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

namespace Docs\Controllers;

use Phalcon\Config;
use Phalcon\Mvc\View\Simple;
use Phalcon\Cache\BackendInterface;
use Phalcon\Mvc\Controller as PhController;
use function Docs\Functions\config;
use function Docs\Functions\app_path;
use function Docs\Functions\environment;

/**
 * Docs\Controllers\BaseController
 *
 * @property Config           $config
 * @property BackendInterface $cacheData
 * @property \ParsedownExtra  $parsedown
 * @property Simple           $viewSimple
 *
 * @package Docs\Controllers
 */
class BaseController extends PhController
{
    /**
     * @param string $language
     * @param string $version
     * @param string $fileName
     *
     * @return string
     */
    protected function getDocument($language, $version, $fileName): string
    {
        $key = sprintf('%s.%s.%s.cache', $fileName, $version, $language);

        if (environment('production') && true === $this->cacheData->exists($key)) {
            return $this->cacheData->get($key);
        }

        $pageName    = app_path(sprintf('docs/%s/%s/%s.md', $version, $language, $fileName));
        $apiFileName = app_path(sprintf('docs/%s/%s/api/%s.md', $version, $language, $fileName));

        $data = '';
        if (file_exists($pageName)) {
            $data = file_get_contents($pageName);
        } elseif (file_exists($apiFileName)) {
            $data = file_get_contents($apiFileName);
        }

        if (empty($data)) {
            // the article does not exists
            return '';
        }

        $namespaces = $this->getNamespaces();
        $from       = array_keys($namespaces);
        $to         = array_values($namespaces);

        /**
         * API links
         */
        $data = str_replace($from, $to, $data);

        /**
         * Language and version
         */
        $data = str_replace(
            [
                '[[language]]',
                '[[version]]',
                '0#', '1#', '2#', '3#', '4#',
                '5#', '6#', '7#', '8#', '9#',
                '0`', '1`', '2`', '3`', '4`',
                '5`', '6`', '7`', '8`', '9`',
            ],
            [
                $language,
                $this->getVersion(),
                '#', '#', '#', '#', '#',
                '#', '#', '#', '#', '#',
                '`', '`', '`', '`', '`',
                '`', '`', '`', '`', '`',
            ],
            $data
        );
        $data = $this->parsedown->text($data);
        $this->cacheData->save($key, $data);

        return $data;
    }

    /**
     * Gets all the namespaces so that API URLs are generated properly
     *
     * @return array
     */
    protected function getNamespaces(): array
    {
        $key = 'namespaces.cache';
        if (environment('production') && true === $this->cacheData->exists($key)) {
            return $this->cacheData->get($key);
        }

        $namespaces = [];
        $template   = '[%s](/[[language]]/[[version]]/api/%s)';

        $data = get_declared_classes();
        foreach ($data as $name) {
            if (substr($name, 0, 8) === 'Phalcon\\') {
                $apiName               = str_replace('\\', '_', $name);
                $namespaces["`$name`"] = sprintf($template, $name, $apiName);
            }
        }

        $data = get_declared_interfaces();
        foreach ($data as $name) {
            if (substr($name, 0, 8) === 'Phalcon\\') {
                $apiName               = str_replace('\\', '_', $name);
                $namespaces["`$name`"] = sprintf($template, $name, $apiName);
            }
        }

        $this->cacheData->save($key, $namespaces);

        return $namespaces;
    }

    /**
     * Check the available languages and return either that or 'en'
     *
     * @param string $language
     *
     * @return string
     */
    protected function getLanguage(string $language): string
    {
        $languages = config('languages');

        if (!isset($languages[$language])) {
            return 'en';
        }

        return $language;
    }

    /**
     * Returns the current version string with its prefix if applicable
     *
     * @param  string $stub
     * @param  string $version
     * @return string
     */
    protected function getVersion(string $stub = '', string $version = ''): string
    {
        if (empty($version) || strtolower($version) === 'latest') {
            $version = config('app.version', '9999');
        } else {
            $version = filter_var($version, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $version = $version ?? config('app.version', '9999');
        }

        return $stub . $version;
    }
}
