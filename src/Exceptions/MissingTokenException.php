<?php

namespace RSGMSales\Connector\Exceptions;

use Throwable;

class MissingTokenException extends \Exception
{
    public function __construct(string $message = "User token is missing", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
