<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon                                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2018 Phalcon Team (https://phalconphp.com)          |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/

namespace Docs\Mvc\View;

/**
 * Docs\Mvc\View\VoltFunctions
 *
 * @package Docs\Mvc\View
 */
class VoltFunctions
{
    /**
     * Compile any function call in a template
     *
     * @param string $name      function name
     * @param mixed  $arguments function args
     *
     * @return string|null Compiled function if any
     */
    public function compileFunction(string $name, $arguments)
    {
        if (function_exists($name)) {
            return $name . '(' . $arguments . ')';
        }

        switch ($name) {
            case 'assets_uri':
                return "\\Docs\\Functions\\assets_uri({$arguments})";
            case 'environment':
                return "\\Docs\\Functions\\environment({$arguments})";
            case 'config':
                return "\\Docs\\Functions\\config({$arguments})";
        }

        return null;
    }
}
