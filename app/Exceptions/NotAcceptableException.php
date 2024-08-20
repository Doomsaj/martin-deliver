<?php

namespace App\Exceptions;

class NotAcceptableException extends RestException
{
    public function __construct(string $message = "Not acceptable")
    {
        parent::__construct(406, $message, now(), $message, 0, null);
    }
}
