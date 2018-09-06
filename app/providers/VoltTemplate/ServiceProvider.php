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

namespace Docs\Providers\VoltTemplate;

use Docs\Mvc\View\VoltFunctions;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\ViewBaseInterface;
use function Docs\Functions\app_path;
use function Docs\Functions\cache_path;
use function Docs\Functions\config;
use function Docs\Functions\container;
use function Docs\Functions\environment;

/**
 * Docs\Providers\VoltTemplate\ServiceProvider
 *
 * @package Docs\Providers\VoltTemplate
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
        $service = function (ViewBaseInterface $view, DiInterface $container = null) {
            $volt = new Volt($view, $container ?: container());

            $volt->setOptions(
                [
                    'compiledPath'  => function ($path) {
                        $path     = trim(substr($path, strlen(app_path())), '\\/');
                        $filename = basename(str_replace(['\\', '/'], '_', $path), '.volt');

                        $cacheDir = cache_path('volt');
                        if (!is_dir($cacheDir) && !mkdir($cacheDir, 0755, true)) {
                            trigger_error('Unable to locate/create the Volt cache dir', E_USER_ERROR);
                        }

                        $filename = sprintf('%s.%s.php', $filename, config('app.version', '9999'));

                        return $cacheDir . DIRECTORY_SEPARATOR . $filename;
                    },
                    'compileAlways' => environment('development'),
                ]
            );


            $volt->getCompiler()
                ->addExtension(new VoltFunctions());

            return $volt;
        };

        $container->setShared('volt', $service);
    }
}
