<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
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
