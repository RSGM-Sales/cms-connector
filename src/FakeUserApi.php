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
        return BaseApiResponse::create(
            new Response(
                \Symfony\Component\HttpFoundation\Response::HTTP_OK,
                ['Content-Type' => 'application/json'],
                json_encode([
                    "data" => [],
                    "links" => [
                        "first" => "https://services-cms.test/api/users/orders/products?page=1",
                        "last" => "https://services-cms.test/api/users/orders/products?page=1",
                        "prev" => null,
                        "next" => null,
                    ],
                    "meta" => [
                        "current_page" => 1,
                        "from" => null,
                        "last_page" => 1,
                        "links" => [],
                        "path" => "https://services-cms.test/api/users/orders/products",
                        "per_page" => 6,
                        "to" => null,
                        "total" => 0,
                    ]
                ]),
            )
        );
    }

    public function getOrderByOrderNumber(string $orderNumber, mixed $data): BaseApiResponse
    {
        return BaseApiResponse::create(
            new Response(
                \Symfony\Component\HttpFoundation\Response::HTTP_OK,
                ['Content-Type' => 'application/json'],
                json_encode([
                    "data" => [
                        'attributes' => [
                            'orderNumber' => '::ORDER_NUMBER::',
                        ],
                        'relationships' => [
                            'user' => [
                                'attributes' => [
                                    'token' => '::TOKEN::'
                                ]
                            ],
                        ],
                    ],
                ]),
            )
        );
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

        return (new FakeSiteApi())->login('::TOKEN::');
    }
}
