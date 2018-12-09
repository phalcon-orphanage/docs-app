<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

namespace Docs\Cli\Tasks;

use Phalcon\CLI\Task;

/**
 * Docs\Cli\Tasks\MainTask
 *
 * @package Docs\Cli\Tasks
 */
class MainTask extends Task
{
    /**
     * This provides the main menu of commands if an command is not entered
     */
    public function mainAction()
    {
        echo '------------------------------------------------------' . PHP_EOL;
        echo ' Phalcon Docs' . PHP_EOL;
        echo '------------------------------------------------------' . PHP_EOL;
        echo PHP_EOL;
        echo 'Usage: phalcon <command>';

        echo PHP_EOL . PHP_EOL;

        $commands = [
            '  -clear-cache          Clears the cached files',
            '  -regenerate-api       Regenerate From API',
            '  -generate-sitemap     Generates the Sitemap',
        ];

        echo 'Commands:' . PHP_EOL;

        foreach ($commands as $command) {
            echo $command . PHP_EOL;
        }

        echo PHP_EOL;
    }
}
