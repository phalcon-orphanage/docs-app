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

namespace Docs\Providers\View;

use Phalcon\DiInterface;
use Phalcon\Mvc\View\Simple;
use Phalcon\Di\ServiceProviderInterface;
use function Docs\Functions\app_path;
use function Docs\Functions\container;

/**
 * Docs\Providers\View\ServiceProvider
 *
 * @package Docs\Providers\View
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(DiInterface $di)
    {
        $di->setShared(
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
