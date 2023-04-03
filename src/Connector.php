<?php

namespace RSGMSales\Connector;

use Illuminate\Support\Facades\Http;
use mysql_xdevapi\Result;

class Connector
{
    public SiteApi $site;
    public UserApi $user;

    public function __construct()
    {
        $this->site = new SiteApi();
        $this->user = new UserApi();
    }
}
