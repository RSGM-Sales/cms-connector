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

    public function test() {
        $client = new \GuzzleHttp\Client();

        return new ApiResponse($client->post('http://localhost:8001/api/test', [
            'json' => [
                'foo' => 'barrrrr'
            ]
        ]));
    }
}
