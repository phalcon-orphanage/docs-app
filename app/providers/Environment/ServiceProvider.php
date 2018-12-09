<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\Environment;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use function Docs\Functions\container;

/**
 * Docs\Providers\Environment\ServiceProvider
 *
 * @package Docs\Providers\Environment
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
        $container->set(
            'environment',
            function () {
                $environment = container('bootstrap')->getEnvironment();

                if (func_num_args() > 0) {
                    $patterns = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();

                    foreach ($patterns as $pattern) {
                        if ($pattern === $environment) {
                            return true;
                        }
                    }

                    return false;
                }

                return $environment;
            }
        );
    }
}
