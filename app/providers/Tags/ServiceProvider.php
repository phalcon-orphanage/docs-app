<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\Tags;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Phalcon\Tag;
use function Docs\Functions\config;

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
                $title       = config('app.name', 'Documentation');

                $tag->setTitle($title);
                $tag->appendTitle($description);

                return $tag;
            }
        );
    }
}
