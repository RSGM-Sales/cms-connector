<?php

namespace RSGMSales\Connector;

use Throwable;

class MissingTokenExcpetion extends \Exception
{
    public function __construct(string $message = "User token is missing", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
