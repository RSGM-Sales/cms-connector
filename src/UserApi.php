<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Client;
use RSGMSales\Connector\Exceptions\MissingTokenException;
use RSGMSales\Connector\Models\OrderData;
use RSGMSales\Connector\Models\ProfileData;
use RSGMSales\Connector\Responses\BaseApiResponse;

class UserApi implements UserApiInterface
{
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
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function changeEmail(string $email): BaseApiResponse {
        return BaseApiResponse::create($this->getClient()->post(config('cms.endpoints.user.changeEmail'), [
            'json' => [
                'email' => $email
            ]
        ]));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function requestNewPassword(): BaseApiResponse {
        return BaseApiResponse::create($this->getClient()->get(config('cms.endpoints.user.changePassword')));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function createOrder(OrderData $orderData): BaseApiResponse {
        return BaseApiResponse::create($this->getClient()->post(config('cms.endpoints.user.orders.create'), [
            'json' => $orderData
        ]));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function getOrderHistory(): BaseApiResponse {
        return BaseApiResponse::create($this->getClient()->get(config('cms.endpoints.user.orders.history')));
    }

    /**
     * @throws MissingTokenException|\GuzzleHttp\Exception\GuzzleException
     */
    public function updateProfile(ProfileData $profileData): BaseApiResponse {
        return BaseApiResponse::create($this->getClient()->post(config('cms.endpoints.user.updateProfile', [
            'json' => $profileData
        ])));
    }
}
