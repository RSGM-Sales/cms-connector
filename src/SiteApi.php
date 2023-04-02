<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class SiteApi
{
    private Client $client;

    public function __construct()
    {
        $username = config('connector.site.username');
        $password = config('connector.site.password');
        $site = config('connector.site.id');

        //TODO: Should the password be hashed in the auth header?
        $this->client = new Client([
            'base_uri' => config('cms.base_url'),
            'headers' => [
                'Authorization' => "Basic " . base64_encode("$username:$password"),
                'Site-Id' => $site,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    public function getCurrencies(): ApiResponse {
        return new ApiResponse($this->client->get(config('cms.endpoints.site.currencies')));
    }

    public function getPaymentMethods(): ApiResponse {
        return new ApiResponse($this->client->get(config('cms.endpoints.site.paymentMethods')));
    }

    public function getReviews(): ApiResponse {
        return new ApiResponse($this->client->get(config('cms.endpoints.site.reviews')));
    }

    public function login($username, $password): ApiResponse {
        $response = new ApiResponse($this->client->post(config('cms.endpoints.site.login'), [
            'json' => [
                'username' => $username,
                'password' => bcrypt($password)
            ]
        ]));

        session(['user-api-token' => $response->body['token']]);

        return $response;
    }
}
