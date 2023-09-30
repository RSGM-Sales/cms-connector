<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Contracts\SiteApiInterface;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;


class FakeSiteApi implements SiteApiInterface
{
    public function confirmEmail(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getGames(): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getCurrencies(): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getPaymentMethods(): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getReviews(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function login(mixed $data): LoginApiResponse
    {
        $token = fake()->uuid();
        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', (object)[
            "data" => (object)[
                "type" => "user",
                "attributes" => (object)[
                    "username" => fake()->email(),
                    "token" => $token,
                    "firstName" => fake()->firstName(),
                    "lastName" => fake()->lastName(),
                    "marketingOptIn" => fake()->boolean()
                ]
            ]
        ]);
    }

    public function sendEmailConfirmationMail(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function setNewPassword(mixed $data): LoginApiResponse
    {
        $token = fake()->uuid();
        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', (object)[
            "data" => (object)[
                "type" => "user",
                "attributes" => (object)[
                    "username" => fake()->email(),
                    "token" => $token,
                    "firstName" => fake()->firstName(),
                    "lastName" => fake()->lastName(),
                    "marketingOptIn" => fake()->boolean()
                ]
            ]
        ]);
    }

    public function register(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function requestNewPassword(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }
}
