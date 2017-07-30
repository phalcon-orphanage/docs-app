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

if (php_sapi_name() == "cli-server") {
    // Set timezone
    date_default_timezone_set("UTC");

    $uri = urldecode(
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
    );

    $matches = [];
    if (preg_match("/(.+)\.(?:\d+)\.(js|css|png|jpg|jpeg|gif)$/", $uri, $matches)) {
        $rewritten_uri = $matches[1] . "." . $matches[2];
        $rewritten_path = __DIR__ . '/public' . $rewritten_uri;
        $pathinfo = pathinfo($rewritten_path);
        switch ($pathinfo['extension']) {
            case 'css':
                header("Content-Type: " . "text/css");
                break;
            case 'js':
                header("Content-Type: " . "text/css");
                break;
            case 'png':
            case 'jpg':
            case 'jpeg':
            case 'gif':
                header("Content-Type: image/" . $pathinfo['extension']);
                break;
            default:
                header("Content-Type: " . "text/plain");
        }
        return readfile($rewritten_path);
    }

    if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
        return false;
    }

    $_GET['_url'] = $_SERVER['REQUEST_URI'];

    require_once __DIR__ . '/public/index.php';
}
