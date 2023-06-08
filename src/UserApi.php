<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RSGMSales\Connector\Dto\CreateReviewData;
use RSGMSales\Connector\Exceptions\MissingTokenException;
use RSGMSales\Connector\Dto\CreateOrderData;
use RSGMSales\Connector\Dto\UserPreferencesData;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;
use RSGMSales\Connector\Responses\OrderHistoryApiResponse;

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
    public function createOrder(CreateOrderData $orderData): BaseApiResponse {
        return BaseApiResponse::create($this->getClient()->post(config('cms.endpoints.user.orders.create'), [
            'json' => $orderData
        ]));
    }

    /**
     * @throws GuzzleException
     * @throws MissingTokenException
     */
    public function createReview(CreateReviewData $feedbackData): BaseApiResponse
    {
        return BaseApiResponse::create($this->getClient()->post(config('cms.endpoints.user.reviews.create'), [
            'json' => $feedbackData
        ]));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrderHistory(int $page = null): OrderHistoryApiResponse {
        return OrderHistoryApiResponse::create($this->getClient()->get(config('cms.endpoints.user.orders.history')));
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
    public function updateProfile(UserPreferencesData $profileData): BaseApiResponse {
        $response = LoginApiResponse::create($this->getClient()->post(config('cms.endpoints.user.updateProfile'), [
            'json' => $profileData
        ]));

        if($response->statusCode === 200) {
            session(['user-api-token' => $response->user()->token()]);
        }

        return $response;
    }
}
