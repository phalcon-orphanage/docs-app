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

namespace Docs\Providers\UrlResolver;

use Phalcon\Mvc\Url;
use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use function Docs\Functions\container;

/**
 * Docs\Providers\UrlResolver\ServiceProvider
 *
 * @package Docs\Providers\UrlResolver
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $di->setShared(
            'url',
            function () {
                $config = container('config');

                $url = new Url();

                $url->setBaseUri($config->get('app')->get('baseUri', '/'));
                $url->setStaticBaseUri($config->get('app')->get('staticUrl', '/'));

                return $url;
            }
        );
    }
}
