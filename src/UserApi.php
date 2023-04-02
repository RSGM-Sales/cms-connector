<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Client;
use mysql_xdevapi\Exception;
use mysql_xdevapi\Result;

class UserApi
{
    private function getClient(): Client {
        // I'm choosing to create a new client here on every request because I'm not sure when the user api token is being set in the session
        $token = session('user-api-token');
        $site = config('connector.site.id');

        if($token == null) {
            throw new MissingTokenExcpetion();
        }

        return new Client([
            'base_uri' => config('connector.apiBaseUrl'),
            'headers' => [
                'Authorization' => "Bearer $token",
                'Site-Id' => $site,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * @throws MissingTokenExcpetion|\GuzzleHttp\Exception\GuzzleException
     */
    public function changeEmail(string $email): ApiResponse {
        return new ApiResponse($this->getClient()->post(config('cms.endpoints.user.changeEmail'), [
            'json' => [
                'email' => $email
            ]
        ]));
    }

    /**
     * @throws MissingTokenExcpetion|\GuzzleHttp\Exception\GuzzleException
     */
    public function requestNewPassword(): ApiResponse {
        return new ApiResponse($this->getClient()->get(config('cms.endpoints.user.changePassword')));
    }

    /**
     * @throws MissingTokenExcpetion|\GuzzleHttp\Exception\GuzzleException
     */
    public function createOrder(OrderData $orderData): ApiResponse {
        return new ApiResponse($this->getClient()->post(config('cms.endpoints.user.orders.create'), [
            'json' => $orderData
        ]));
    }

    /**
     * @throws MissingTokenExcpetion|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrderHistory(): ApiResponse {
        return new ApiResponse($this->getClient()->get(config('cms.endpoints.user.orders.history')));
    }

    /**
     * @throws MissingTokenExcpetion|\GuzzleHttp\Exception\GuzzleException
     */
    public function updateProfile(ProfileData $profileData): ApiResponse {
        return new ApiResponse($this->getClient()->post(config('cms.endpoints.user.updateProfile', [
            'json' => $profileData
        ])));
    }
}
