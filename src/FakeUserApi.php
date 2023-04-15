<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Dto\OrderData;
use RSGMSales\Connector\Dto\UserFeedbackData;
use RSGMSales\Connector\Dto\UserPreferencesData;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;
use RSGMSales\Connector\Responses\OrderHistoryApiResponse;

class FakeUserApi implements UserApiInterface
{
    public function createFeedback(UserFeedbackData $feedbackData): BaseApiResponse
    {
        return new BaseApiResponse();
    }
    public function requestNewPassword(string $redirectUrl): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function setNewPassword(string $password): LoginApiResponse
    {
        $token = fake()->uuid();
        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', [
            "username" => fake()->name(),
            "token" => $token
        ]);
    }

    public function createOrder(OrderData $orderData): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getOrderHistory(): OrderHistoryApiResponse
    {
        $data = [];

        for ($i = 0; $i < 6; $i++) {
            $data[] = (object)[
                'id' => $i,
                'attributes' => (object)[
                    'date' => fake()->date,
                    'amount' => rand(2, 5),
                    'total' => rand(12, 20),
                    'status' => fake()->randomElement(['pending', 'delivered', 'failed'])
                ],
                'relationships' => (object)[
                    'currency' => (object)[ "id" => 1, "attributes" => (object)["name" => "Euro", "code" => "EUR", "rate" => 1, "symbol" => "€"] ]
                ],
            ];
        }

        return new OrderHistoryApiResponse(200, "", (object)[
            'data' => $data
        ]);
    }

    public function updateProfile(UserPreferencesData $profileData): BaseApiResponse
    {
        return new BaseApiResponse();
    }
}
