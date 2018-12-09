<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
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
