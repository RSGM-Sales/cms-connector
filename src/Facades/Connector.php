<?php

namespace RSGMSales\Connector\Facades;

use Illuminate\Support\Facades\Facade;
use RSGMSales\Connector\Connector as ConnectorImplementation;
use RSGMSales\Connector\Contracts\ApiInterface;

/**
 * @method static ConnectorImplementation fake()
 * @method static ApiInterface site()
 * @method static ApiInterface user()
 */
class Connector extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ConnectorImplementation::class;
    }
}
