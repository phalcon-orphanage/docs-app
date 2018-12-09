<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
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
