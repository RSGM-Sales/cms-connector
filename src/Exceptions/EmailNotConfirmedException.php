<?php

namespace RSGMSales\Connector\Exceptions;

use Throwable;

class EmailNotConfirmedException extends \Exception
{
    public function __construct(string $message = "The email address has not been confirmed yet", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
