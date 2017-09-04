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

namespace Docs\Cli\Tasks;

use Phalcon\CLI\Task;
use FilesystemIterator;
use Dariuszp\CliProgressBar;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use function Docs\Functions\app_path;

/**
 * ClearCacheTask
 */
class ClearCacheTask extends Task
{
    /**
     * This provides the main menu of commands if an command is not entered
     */
    public function mainAction()
    {
        $this->clearFolder('Data', 'data');
        $this->clearFolder('View', 'view');
        $this->clearFolder('Volt', 'volt');
    }

    /**
     * Iterates through a cache folder and removes the contents
     *
     * @param string $message
     * @param string $folder
     */
    private function clearFolder(string $message, string $folder)
    {

        echo sprintf('Clearing the %s cache', $message) . PHP_EOL;

        $path        = app_path('storage/cache/' . $folder);
        $dirIterator = new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS);
        $iterator    = new RecursiveIteratorIterator(
            $dirIterator,
            RecursiveIteratorIterator::CHILD_FIRST
        );

        $steps = count($iterator);
        $bar   = new CliProgressBar($steps);
        $bar
            ->setColorToGreen()
            ->display();
        foreach ($iterator as $file) {
            if (true !== $file->isDir() &&
                ('php' === $file->getExtension() || 'cache' === $file->getExtension())
            ) {
                $bar->progress();
                unlink($file->getPathname());
            }
        }
        $bar->end();
    }
}
