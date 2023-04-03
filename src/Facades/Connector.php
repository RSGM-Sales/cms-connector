<?php

namespace RSGMSales\Connector\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \RSGMSales\Connector\Connector fake()
 */
class Connector extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'connector';
    }

}
