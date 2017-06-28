<?php

namespace Docs;

use Phalcon\Mvc\User\Component;

/**
 * Class Docs
 *
 * @package Docs
 *
 * @property \Phalcon\Config $config
 */
class Utils extends Component
{
    /**
     * Checks an object or an array if an element exists. If yes it returns
     * the value of the element, otherwise the $default value
     *
     * This method uses 'return' statements when the conditions are met in
     * order to speed things up.
     *
     * @param object|array $data
     * @param string       $element
     * @param string       $default
     *
     * @return mixed
     */
    public function fetch($data, $element, $default = '')
    {
        if (true === is_object($data) && true === isset($data->$element)) {
            return $data->$element;
        } elseif (true === is_array($data) && true === isset($data[$element])) {
            return $data[$element];
        }

        return $default;
    }

    /**
     * @param string $lang
     *
     * @return string
     */
    public function getDocsUrl(string $lang): string
    {
        $return    = 'en';
        $languages = $this->config->get('doc_languages')->toArray();

        if (true !== empty($lang)) {
            if (true === array_key_exists($lang, $languages)) {
                $return = $lang;
            }
        }

        return sprintf(
            '%s/%s/latest',
            $this->config->get('app')->get('url', 'https://docs.phalconphp.com'),
            $return
        );
    }

    /**
     * Returns an asset with the CDN and the version
     *
     * @param string $asset
     * @param string|int $version
     *
     * @return string
     */
    public function getAsset(string $asset, $version): string
    {
        $cdnUrl    = $this->getCdnUrl();
        $pathInfo  = pathinfo($asset);
        $dirName   = $pathInfo['dirname'];
        $fileName  = $pathInfo['filename'];
        $extension = $pathInfo['extension'];

        return sprintf(
            '%s%s/%s.%s.%s',
            $cdnUrl,
            $dirName,
            $fileName,
            $version,
            $extension
        );
    }

    /**
     * Returns the CDN URL
     *
     * @param string $resource
     *
     * @return string
     */
    public function getCdnUrl(string $resource = ''): string
    {
        return $this->config->get('app')->get('staticUrl', '/') . $resource;
    }

    /**
     * Is the CDN local or not
     *
     * @return bool
     */
    public function isCdnLocal(): bool
    {
        return boolval('/' === $this->getCdnUrl());
    }
}
