<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Models\OrderData;
use RSGMSales\Connector\Models\ProfileData;
use RSGMSales\Connector\Responses\BaseApiResponse;

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

    public function getOrderHistory(): BaseApiResponse
    {
        $data = [];

        for ($i = 0; $i < 6; $i++) {
            $data[] = (object)[
                'date' => fake()->date,
                'amount' => rand(2, 5),
                'price' => rand(12, 20),
                'currency' => fake()->randomElement(['Euro', 'Dollar']),
                'status' => fake()->randomElement(['pending', 'delivered', 'failed']),
            ];
        }

        return new BaseApiResponse(200, "", [
            "data" => $data
        ]);
    }

    public function updateProfile(ProfileData $profileData): BaseApiResponse
    {
        return new BaseApiResponse();
    }
}
