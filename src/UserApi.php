<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Client;

class UserApi
{
    private Client $client;

    public function __construct()
    {
        $token = session()->get('user-api-token');

        $this->client = new Client([
            'base_uri' => config('cms.base_url'),
            'headers' => [
                'Authorization' => "Bearer $token"
            ]
        ]);
    }
}
