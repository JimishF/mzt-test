<?php

namespace App\Exceptions;

use Exception;

class CandidateHiringException extends Exception
{
    public function __construct($message = "Unable to hire a candidate", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
