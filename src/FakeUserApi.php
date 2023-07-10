<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Contracts\UserApiInterface;
use RSGMSales\Connector\Dto\CreateOrderData;
use RSGMSales\Connector\Dto\CreateReviewData;
use RSGMSales\Connector\Dto\UserPreferencesData;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

class FakeUserApi implements UserApiInterface
{
    public function createReview(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function createOrder(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getOrderHistory(int $page = 0): BaseApiResponse
    {
        $data = [];

        for ($i = 0; $i < 6; $i++) {
            $data[] = (object)[
                'type' => 'orderProduct',
                'attributes' => [
                    'type' => 'orderProduct',
                    'attributes' => [
                        'amount' => fake()->randomFloat(2, 1, 10),
                        'status' => fake()->randomElement(['initiated', 'delivered', 'failed']),
                        'orderNumber' => fake()->randomNumber(8),
                        'currencyIsoCode' => fake()->currencyCode(),
                        'currencyName' => fake()->randomElement(['euro', 'dollar', 'yen']),
                        'providerName' => fake()->randomElement(['visa', 'bancontact', 'gtA']),
                        'providerFee' => fake()->randomNumber(2),
                        'couponCode' => fake()->randomNumber(4),
                        'couponAmount' => fake()->randomNumber(2),
                        'createdAt' => fake()->date(),
                    ]
                ]
            ];
        }

        return new BaseApiResponse(200, "", (object)[
            'data' => $data
        ]);
    }

    public function logout(): BaseApiResponse
    {
        session(['user-api-token' => null]);
        return new BaseApiResponse();
    }

    public function updateProfile(mixed $data): LoginApiResponse
    {
        $token = fake()->uuid();
        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', (object)[
            "data" => (object) [
                "type" => "user",
                "attributes" => (object) [
                    "email" => $profileData->email ?? fake()->email(),
                    "token" => $token,
                    "firstName" => fake()->firstName(),
                    "lastName" => fake()->lastName(),
                    "marketingOptIn" => $profileData->marketingOptIn ?? fake()->boolean()
                ]
            ]
        ]);
    }
}
