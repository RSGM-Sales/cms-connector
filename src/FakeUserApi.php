<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Psr7\Response;
use RSGMSales\Connector\Contracts\UserApiInterface;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

class FakeUserApi implements UserApiInterface
{
    public function createReview(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    /** @throws \Exception */
    public function createOrder(mixed $data): BaseApiResponse
    {
        if (is_null(session()->get('user-api-token'))) {
            throw new \Exception('', \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
        }

        return BaseApiResponse::create(
            new Response(
                \Symfony\Component\HttpFoundation\Response::HTTP_OK,
                ['Content-Type' => 'application/json'],
                json_encode(['redirectUrl' => $data['siteRedirectUrl']]),
            )
        );
    }

    public function getOrderHistory(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getOrderProductHistory(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getOrderByOrderNumber(string $orderNumber, mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
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
