<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RSGMSales\Connector\Contracts\SiteApiInterface;
use RSGMSales\Connector\Exceptions\MissingTokenException;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

class SiteApi extends RSGMApi implements SiteApiInterface
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
                'User-IP' => $this->getUserIPAddress(),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function confirmEmail(mixed $data): BaseApiResponse
    {
        return BaseApiResponse::create($this->client->post(config('cms.endpoints.site.confirmEmail'), [
            'json' => $data
        ]));
    }

    /**
     * @throws GuzzleException
     */
    public function getGames(): BaseApiResponse {
        return BaseApiResponse::create($this->client->get(config('cms.endpoints.site.games')));
    }

    /**
     * @throws GuzzleException
     */
    public function getCurrencies(): BaseApiResponse {
        return BaseApiResponse::create($this->client->get(config('cms.endpoints.site.currencies')));
    }

    /**
     * @throws GuzzleException
     */
    public function getPaymentMethods(): BaseApiResponse {
        return BaseApiResponse::create($this->client->get(config('cms.endpoints.site.paymentMethods')));
    }

    /**
     * @throws GuzzleException
     */
    public function getReviews(mixed $data): BaseApiResponse {
        return BaseApiResponse::create($this->client->get(config('cms.endpoints.site.reviews'), [
            'json' => $data
        ]));
    }

    /**
     * @throws GuzzleException
     */
    public function login(mixed $data): LoginApiResponse {
        $response = LoginApiResponse::create($this->client->post(config('cms.endpoints.site.login'), [
            'json' => $data
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->user()->token()]);
        }

        return $response;
    }

    public function sendEmailConfirmationMail(mixed $data): BaseApiResponse
    {
        return BaseApiResponse::create($this->client->post(config('cms.endpoints.site.sendEmailConfirmationMail'), [
            'json' => $data
        ]));
    }

    /**
     * @throws GuzzleException
     * @throws MissingTokenException
     */
    public function setNewPassword(mixed $data): LoginApiResponse
    {
        $response = LoginApiResponse::create($this->client->post(config('cms.endpoints.site.changePassword'), [
            'json' => $data
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->user()->token()]);
        }

        return $response;
    }

        /**
         * @throws GuzzleException
         */
    public function register(mixed $data): BaseApiResponse
    {
        return BaseApiResponse::create($this->client->post(config('cms.endpoints.site.register'), [
            'json' => $data
        ]));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function requestNewPassword(mixed $data): BaseApiResponse {
        return BaseApiResponse::create($this->client->post(config('cms.endpoints.site.requestNewPassword'), [
            'query' => $data
        ]));
    }

    public function getCoupon(mixed $data): BaseApiResponse {
        return BaseApiResponse::create($this->client->get(config('cms.endpoints.site.getCouponByName'), [
            'json' => $data
        ]));
    }

    public function getPriceCalculation(mixed $data): BaseApiResponse {
        return BaseApiResponse::create($this->client->post(config('cms.endpoints.site.getPriceCalculation'), [
            'json' => $data
        ]));
    }
}
