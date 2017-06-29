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

namespace Docs\Providers\Logger;

use Phalcon\DiInterface;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\File;
use Phalcon\Logger\Formatter\Line;
use Phalcon\Di\ServiceProviderInterface;
use function Docs\Functions\app_path;
use function Docs\Functions\config;

/**
 * Docs\Providers\Logger\ServiceProvider
 *
 * @package Docs\Providers\Logger
 */
class ServiceProvider implements ServiceProviderInterface
{
    const DEFAULT_LEVEL = 'debug';
    const DEFAULT_FORMAT = '[%date%][%type%] %message%';
    const DEFAULT_DATE = 'd-M-Y H:i:s';
    const DEFAULT_FILENANE = 'application';

    protected $logLevels = [
        'emergency' => Logger::EMERGENCY,
        'emergence' => Logger::EMERGENCE,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'error'     => Logger::ERROR,
        'warning'   => Logger::WARNING,
        'notice'    => Logger::NOTICE,
        'info'      => Logger::INFO,
        'debug'     => Logger::DEBUG,
        'custom'    => Logger::CUSTOM,
        'special'   => Logger::SPECIAL,
    ];

    public function register(DiInterface $di)
    {
        $logLevels = $this->logLevels;

        $di->set(
            'logger',
            function ($filename = null, $format = null) use ($logLevels) {
                // Setting up the log level
                $level = config('logger.level', self::DEFAULT_LEVEL);

                if (!array_key_exists($level, $logLevels)) {
                    $level = Logger::DEBUG;
                } else {
                    $level = $logLevels[$level];
                }

                // Setting up date format
                $date = config('logger.date', self::DEFAULT_DATE);

                // Format setting up
                if (empty($format)) {
                    $format = config('logger.format', self::DEFAULT_FORMAT);
                }

                // Setting up the filename
                if (empty($filename)) {
                    $filename = config('logger.defaultFilename', self::DEFAULT_FILENANE);
                }

                $filename = trim($filename, '\\/');
                if (!strpos($filename, '.log')) {
                    $filename = rtrim($filename, '.') . '.log';
                }

                $logger = new File(app_path(sprintf("storage/logs/%s-%s", date('Ymd'), $filename)));

                $logger->setFormatter(new Line($format, $date));
                $logger->setLogLevel($level);

                return $logger;
            }
        );
    }
}
