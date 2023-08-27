<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RSGMSales\Connector\Contracts\UserApiInterface;
use RSGMSales\Connector\Dto\CreateOrderData;
use RSGMSales\Connector\Dto\CreateReviewData;
use RSGMSales\Connector\Dto\UserPreferencesData;
use RSGMSales\Connector\Exceptions\MissingTokenException;
use RSGMSales\Connector\Responses\BaseApiPagedResponse;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

class UserApi extends RSGMApi implements UserApiInterface
{
    /**
     * @throws MissingTokenException
     */
    private function getClient(): Client {
        // I'm choosing to create a new client here on every request because I'm not sure when the user api token is being set in the session
        $token = session('user-api-token');
        $site = config('connector.site.id');

        if($token == null) {
            throw new MissingTokenException();
        }

        return new Client([
            'base_uri' => config('connector.apiBaseUrl'),
            'headers' => [
                'Authorization' => "Bearer $token",
                'Site-Id' => $site,
                'User-IP' => $this->getUserIPAddress(),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function createOrder(mixed $data): BaseApiResponse {
        return BaseApiResponse::create($this->getClient()->post(config('cms.endpoints.user.orders.create'), [
            'json' => $data
        ]));
    }

    /**
     * @throws GuzzleException
     * @throws MissingTokenException
     */
    public function createReview(mixed $data): BaseApiResponse
    {
        return BaseApiResponse::create($this->getClient()->post(config('cms.endpoints.user.reviews.create'), [
            'json' => $data
        ]));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrderHistory(mixed $data): BaseApiResponse {
        return BaseApiResponse::create($this->getClient()->get(config('cms.endpoints.user.orders.history'), [
            'json' => $data
        ]));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrderProductHistory(mixed $data): BaseApiResponse {
        return BaseApiResponse::create($this->getClient()->get(config('cms.endpoints.user.orders.productHistory'), [
            'json' => $data
        ]));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrderByOrderNumber(string $orderNumber, mixed $data): BaseApiResponse
    {
        return BaseApiResponse::create($this->getClient()->get(config('cms.endpoints.user.orders.orderNumber') . "$orderNumber", [
                'json' => $data
            ]
        ));
    }

    /**
     * @throws GuzzleException
     * @throws MissingTokenException
     */
    public function logout(): BaseApiResponse
    {
        $response = BaseApiResponse::create($this->getClient()->post(config('cms.endpoints.user.logout')));

        if($response->statusCode === 200)
        {
            session(['user-api-token' => null]);
        }

        return $response;
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function updateProfile(mixed $data): LoginApiResponse {
        $response = LoginApiResponse::create($this->getClient()->post(config('cms.endpoints.user.updateProfile'), [
            'json' => $data
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->user()->token()]);
        }

        return $response;
    }
}
