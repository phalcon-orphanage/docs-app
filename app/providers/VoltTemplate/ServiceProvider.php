<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
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
