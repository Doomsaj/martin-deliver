<?php

namespace App\Exceptions;

class BadRequestException extends RestException
{
    public function __construct(string $message = "Bad Request")
    {
        parent::__construct(400, $message, now(), $message, 0, null);
    }
}
