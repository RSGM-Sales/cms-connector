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
    public function confirmEmail(string $email): BaseApiResponse
    {
        return BaseApiResponse::create($this->client->post(config('cms.endpoints.site.confirmEmail'), [
            'json' => [
                'email' => $email,
            ]
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
    public function getReviews(int $page = 0): BaseApiResponse {
        return BaseApiResponse::create($this->client->get(config('cms.endpoints.site.reviews')));
    }

    /**
     * @throws GuzzleException
     */
    public function login($email, $password): LoginApiResponse {
        $response = LoginApiResponse::create($this->client->post(config('cms.endpoints.site.login'), [
            'json' => [
                'email' => $email,
                'password' => $password
            ]
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->user()->token()]);
        }

        if($response->statusCode === 401 && $response->body === "The email address has not been confirmed yet") {
            throw new EmailNotConfirmedException();
        }

        return $response;
    }

    public function sendEmailConfirmationMail(string $email, string $emailConfirmationUrl): BaseApiResponse
    {
        return BaseApiResponse::create($this->client->post(config('cms.endpoints.site.sendEmailConfirmationMail'), [
            'json' => [
                'email' => $email,
                'emailConfirmationUrl' => $emailConfirmationUrl,
            ]
        ]));
    }

    /**
     * @throws GuzzleException
     * @throws MissingTokenException
     */
    public function setNewPassword(string $email, string $password): LoginApiResponse
    {
        $response = LoginApiResponse::create($this->client->post(config('cms.endpoints.site.changePassword'), [
            'json' => [
                'email' => $email,
                'password' => $password
            ]
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->user()->token()]);
        }

        return $response;
    }

        /**
         * @throws GuzzleException
         */
    public function register(string $email, string $password, string $emailConfirmationUrl, string $firstName, string $lastName = null): BaseApiResponse
    {
        return BaseApiResponse::create($this->client->post(config('cms.endpoints.site.register'), [
            'json' => [
                'email' => $email,
                'password' => $password,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'emailConfirmationUrl' => $emailConfirmationUrl,
            ]
        ]));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function requestNewPassword(string $email, string $redirectUrl): BaseApiResponse {
        return BaseApiResponse::create($this->client->post(config('cms.endpoints.site.requestNewPassword'), [
            'query' => [
                'email' => $email,
                'redirectUrl' => $redirectUrl
            ]
        ]));
    }


}
