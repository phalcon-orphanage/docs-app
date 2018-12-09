<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Providers\View;

use Phalcon\Di\ServiceProviderInterface;
use Phalcon\DiInterface;
use Phalcon\Mvc\View\Simple;
use function Docs\Functions\app_path;
use function Docs\Functions\container;

/**
 * Docs\Providers\View\ServiceProvider
 *
 * @package Docs\Providers\View
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
            'viewSimple',
            function () {
                $mode = container('bootstrap')->getMode();

                switch ($mode) {
                    case 'normal':
                    case 'cli':
                        $view = new Simple();
                        break;
                    default:
                        throw new \InvalidArgumentException(
                            sprintf(
                                'Invalid application mode. Expected either "normal" or "cli". Got "%s".',
                                is_scalar($mode) ? $mode : var_export($mode, true)
                            )
                        );
                }

                $view->registerEngines([
                    '.volt' => container('volt', [$view, $this]),
                ]);

                $view->setViewsDir(app_path('app/views/'));

                $eventsManager = container('eventsManager');

                //  @todo
                // $eventsManager->attach('view', new ViewListener());

                $view->setEventsManager($eventsManager);

                return $view;
            }
        );
    }
}
