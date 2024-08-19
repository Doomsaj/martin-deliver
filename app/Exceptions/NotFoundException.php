<?php

namespace App\Exceptions;

class NotFoundException extends RestException
{
    public function __construct(string $message = "Requested resource not found")
    {
        parent::__construct(404, $message, now(), $message, 0, null);
    }
}
