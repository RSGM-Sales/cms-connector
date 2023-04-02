<?php

namespace RSGMSales\Connector;

use Illuminate\Support\Facades\Http;

class Connector
{
    public SiteApi $site;

    public function __construct()
    {
        $this->site = new SiteApi();
    }
}
