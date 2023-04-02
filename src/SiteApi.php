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

        //TODO: Should the password be hashed in the auth header?
        $this->client = new Client([
            'base_uri' => config('cms.base_url'),
            'headers' => [
                'Authorization' => "Basic " . base64_encode("$username:$password")
            ]
        ]);
    }

    public function getCurrencies() {
        return $this->client->get(config('cms.endpoints.site.currencies'));
    }

    public function getPaymentMethods() {
        return $this->client->get(config('cms.endpoints.site.paymentMethods'));
    }

    public function getReviews() {
        return $this->client->get(config('cms.endpoints.site.reviews'));
    }

    public function login($username, $password) {
        $response = $this->client->post(config('cms.endpoints.site.login'), [
            'form_params' => [
                'username' => $username,
                'password' => bcrypt($password),
            ]
        ]);


    }
}
