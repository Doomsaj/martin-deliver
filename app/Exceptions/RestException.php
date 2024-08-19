<?php

namespace App\Exceptions;

use DateTime;
use Exception;

class RestException extends Exception
{
    public int $statusCode;
    public string $errorMessage;
    public DateTime $timestamp;

    public function __construct(int $statusCode, string $errorMessage, DateTime $timestamp, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->statusCode = $statusCode;
        $this->errorMessage = $errorMessage;
        $this->timestamp = $timestamp;
    }
}
