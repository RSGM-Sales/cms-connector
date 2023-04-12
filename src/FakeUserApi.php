<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Dto\OrderData;
use RSGMSales\Connector\Dto\ProfileData;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\OrderHistoryApiResponse;

class FakeUserApi implements UserApiInterface
{

    public function changeEmail(string $email): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function requestNewPassword(): BaseApiResponse
    {
        return new BaseApiResponse();
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

    public function updateProfile(ProfileData $profileData): BaseApiResponse
    {
        return new BaseApiResponse();
    }
}
