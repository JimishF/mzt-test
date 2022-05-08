<?php

namespace App\Exceptions;

use Exception;

class InsufficientCoinsException extends Exception
{
    public function __construct($message = "Insufficient coins", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
