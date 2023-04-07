<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Client;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\CurrencyApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

class SiteApi implements SiteApiInterface
{
    private Client $client;

    public function __construct()
    {
        $username = config('connector.site.username');
        $password = config('connector.site.password');
        $site = config('connector.site.id');

        $this->client = new Client([
            'base_uri' => config('connector.apiBaseUrl'),
            'headers' => [
                'Authorization' => "Basic " . base64_encode("$username:$password"),
                'Site-Id' => $site,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    public function getGames(): BaseApiResponse {
        return BaseApiResponse::create($this->client->get(config('cms.endpoints.site.games')));
    }

    public function getCurrencies(): CurrencyApiResponse {
        return CurrencyApiResponse::create($this->client->get(config('cms.endpoints.site.currencies')));
    }

    public function getPaymentMethods(): BaseApiResponse {
        return BaseApiResponse::create($this->client->get(config('cms.endpoints.site.paymentMethods')));
    }

    public function getReviews(): BaseApiResponse {
        return BaseApiResponse::create($this->client->get(config('cms.endpoints.site.reviews')));
    }

    public function login($username, $password): LoginApiResponse {
        $response = LoginApiResponse::create($this->client->post(config('cms.endpoints.site.login'), [
            'json' => [
                'username' => $username,
                'password' => bcrypt($password)
            ]
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->body['token']]);
        }

        return $response;
    }

    public function register(string $username, string $password, string $name): LoginApiResponse
    {
        $response = LoginApiResponse::create($this->client->post(config('cms.endpoints.site.register'), [
            'json' => [
                'username' => $username,
                'password' => bcrypt($password),
                'name' => $name
            ]
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->body['token']]);
        }

        return $response;
    }
}
