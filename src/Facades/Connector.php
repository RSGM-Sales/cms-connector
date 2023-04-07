<?php

namespace RSGMSales\Connector\Facades;

use Illuminate\Support\Facades\Facade;
use RSGMSales\Connector\SiteApiInterface;

/**
 * @method static \RSGMSales\Connector\Connector fake()
 * @method static SiteApiInterface site()
 */
class Connector extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'connector';
    }

}
