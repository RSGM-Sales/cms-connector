<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Dto\CreateOrderData;
use RSGMSales\Connector\Dto\CreateReviewData;
use RSGMSales\Connector\Dto\UserPreferencesData;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;
use RSGMSales\Connector\Responses\OrderHistoryApiResponse;

class FakeUserApi implements UserApiInterface
{
    public function createReview(CreateReviewData $feedbackData): BaseApiResponse
    {
        return new BaseApiResponse();
    }
    public function createOrder(CreateOrderData $orderData): BaseApiResponse
    {
        return new BaseApiResponse();
    }
    public function getOrderHistory(int $page = 0): OrderHistoryApiResponse
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

        return new OrderHistoryApiResponse(0,0,200, "", (object)[
            'data' => $data
        ]);
    }
    public function logout(): BaseApiResponse
    {
        session(['user-api-token' => null]);
        return new BaseApiResponse();
    }
    public function updateProfile(UserPreferencesData $profileData): BaseApiResponse
    {
        return new BaseApiResponse();
    }
}
