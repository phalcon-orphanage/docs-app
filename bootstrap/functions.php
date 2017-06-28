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

namespace Docs\Functions;

use Closure;
use Phalcon\Di;

/**
 * Get the application path.
 *
 * @param  string $path
 * @return string
 */
function app_path(string $path = '') : string
{
    return dirname(__DIR__) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * Return the default value of the given value.
 *
 * @param  mixed $value
 * @return mixed
 */
function value($value)
{
    return $value instanceof Closure ? $value() : $value;
}

/**
 * Gets the value of an environment variable.
 *
 * @param  string $key
 * @param  mixed  $default
 * @return mixed
 */
function env($key, $default = null)
{
    $value = getenv($key);

    if ($value === false) {
        return value($default);
    }

    switch (strtolower($value)) {
        case 'true':
            return true;
        case 'false':
            return false;
        case 'empty':
            return '';
        case 'null':
            return null;
    }

    return $value;
}

/**
 * Calls the default Dependency Injection container.
 *
 * @param  mixed
 * @return mixed|\Phalcon\DiInterface
 */
function container()
{
    $default = Di::getDefault();
    $args = func_get_args();

    if (empty($args)) {
        return $default;
    }

    if ($default) {
        return call_user_func_array([$default, 'getShared'], $args);
    }

    trigger_error('Unable to resolve Dependency Injection container.', E_USER_ERROR);

    return null;
}

/**
 * Get or check the current application environment.
 *
 * @param  mixed
 * @return string|bool
 */
function environment()
{
    if (func_num_args() > 0) {
        return call_user_func_array([container(), 'getEnvironment'], func_get_args());
    }

    return container()->getEnvironment();
}
