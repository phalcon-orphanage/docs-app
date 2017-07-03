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

namespace Docs\Providers\Tags;

use function Docs\Functions\config;
use Phalcon\Tag;
use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * Docs\Providers\Tags\ServiceProvider
 *
 * @package Docs\Providers\Tags
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
        $container->setShared(
            'tag',
            function () {
                $tag = new Tag();
                $tag->setDocType(Tag::HTML5);
                $tag->setTitleSeparator(' - ');

                $description = config('app.description', 'Phalcon Framework');
                $title = config('app.name', 'Documentation');

                $tag->setTitle($title);
                $tag->appendTitle($description);

                return $tag;
            }
        );
    }
}
