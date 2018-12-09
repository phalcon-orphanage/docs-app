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

use Dariuszp\CliProgressBar;
use FilesystemIterator;
use Phalcon\CLI\Task;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
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
