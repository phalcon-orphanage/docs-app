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

use function Docs\Functions\app_path;

// Register The Composer Auto Loader
require __DIR__ . '/../vendor/autoload.php';

// Load environment
try {
    $result = (new Dotenv\Dotenv(app_path()))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    // Skip
}
