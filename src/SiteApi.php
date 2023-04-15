<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Client;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\CurrencyApiResponse;
use RSGMSales\Connector\Responses\GameApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;
use RSGMSales\Connector\Responses\PaymentOptionApiResponse;
use RSGMSales\Connector\Responses\ReviewApiResponse;

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

    public function getGames(): GameApiResponse {
        return GameApiResponse::create($this->client->get(config('cms.endpoints.site.games')));
    }

    public function getCurrencies(): CurrencyApiResponse {
        return CurrencyApiResponse::create($this->client->get(config('cms.endpoints.site.currencies')));
    }

    public function getPaymentMethods(): PaymentOptionApiResponse {
        return PaymentOptionApiResponse::create($this->client->get(config('cms.endpoints.site.paymentMethods')));
    }

    public function getReviews(int $page = 0): ReviewApiResponse {
        return ReviewApiResponse::create($this->client->get(config('cms.endpoints.site.reviews')));
    }

    public function login($email, $password): LoginApiResponse {
        $response = LoginApiResponse::create($this->client->post(config('cms.endpoints.site.login'), [
            'json' => [
                'username' => $email,
                'password' => $password
            ]
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->body['token']]);
        }

        return $response;
    }

    public function logout(): void
    {
        session(['user-api-token' => null]);
    }

    public function register(string $email, string $password, string $firstName = null, string $lastName = null): LoginApiResponse
    {
        $response = LoginApiResponse::create($this->client->post(config('cms.endpoints.site.register'), [
            'json' => [
                'username' => $email,
                'password' => $password,
                'firstName' => $firstName,
                'lastName' => $lastName
            ]
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->body['token']]);
        }

        return $response;
    }
}
