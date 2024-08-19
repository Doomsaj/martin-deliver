<?php

namespace App\Exceptions;

class AccessDeniedException extends RestException
{
    public function __construct(string $message = "Access Denied!")
    {
        parent::__construct(401, $message, now(), $message, 0, null);
    }
}
