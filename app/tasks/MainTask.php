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
            '  -regenerate-api       Regenerate From API'
        ];

        echo 'Commands:' . PHP_EOL;

        foreach ($commands as $command) {
            echo $command . PHP_EOL;
        }

        echo PHP_EOL;
    }
}
