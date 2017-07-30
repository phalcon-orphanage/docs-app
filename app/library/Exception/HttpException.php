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

namespace Docs\Exception;

use Exception;
use Throwable;

/**
 * Docs\Exception\HttpException
 *
 * @package Docs\Exception
 */
class HttpException extends Exception
{
    public function __construct(string $message, int $code, Throwable $exception = null)
    {
        parent::__construct($message, $code, $exception);
    }
}
