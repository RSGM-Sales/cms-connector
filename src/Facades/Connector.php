<?php

namespace RSGMSales\Connector\Facades;

use Illuminate\Support\Facades\Facade;
use RSGMSales\Connector\SiteApiInterface;
use RSGMSales\Connector\UserApiInterface;

/**
 * @method static \RSGMSales\Connector\Connector fake()
 * @method static SiteApiInterface site()
 * @method static UserApiInterface user()
 */
class Connector extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return 'connector';
    }

}
