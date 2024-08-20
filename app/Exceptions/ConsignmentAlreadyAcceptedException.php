<?php

namespace App\Exceptions;

class ConsignmentAlreadyAcceptedException extends NotAcceptableException
{
    public function __construct()
    {
        parent::__construct("Request is being processed by another courier");
    }
}
