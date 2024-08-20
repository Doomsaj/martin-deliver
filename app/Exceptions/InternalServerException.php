<?php

namespace App\Exceptions;

class InternalServerException extends RestException
{
    public function __construct(string $message = "There was an error while processing your request.")
    {
        parent::__construct(500, $message, now(), $message, 0, null);
    }
}
