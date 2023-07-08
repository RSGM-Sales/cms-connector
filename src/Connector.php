<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Contracts\SiteApiInterface;
use RSGMSales\Connector\Contracts\UserApiInterface;

class Connector
{
    public SiteApiInterface $site;
    public UserApiInterface $user;

    public function __construct()
    {
        $this->site = new SiteApi();
        $this->user = new UserApi();
    }

    public function site(): SiteApiInterface {
        return $this->site;
    }

    public function user(): UserApiInterface {
        return $this->user;
    }

    public static function fake(): Connector {
        $instance = new Connector();

        $instance->site = new FakeSiteApi();
        $instance->user = new FakeUserApi();

        return $instance;
    }
}
