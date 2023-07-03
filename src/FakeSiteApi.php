<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\CurrencyApiResponse;
use RSGMSales\Connector\Responses\GameApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;
use RSGMSales\Connector\Responses\PaymentOptionApiResponse;
use RSGMSales\Connector\Responses\ReviewApiResponse;

class FakeSiteApi implements SiteApiInterface
{
    public function confirmEmail(string $email): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getGames(): GameApiResponse {
        return new GameApiResponse(200, "", (object)[
            "data" => [
                (object)[
                    "id" => 1,
                    "type" => "game",
                    "attributes" => (object)[
                        "name" => "RuneScape"
                    ],
                    "relationships" => (object)[
                        "products" => [
                            (object)[
                                "id" => 1,
                                "type" => "product",
                                "attributes" => (object) [
                                    "name" => "OSRS",
                                    "pricePerUnit" => 0.25
                                ]
                            ],
                            (object)[
                                "id" => 2,
                                "type" => "product",
                                "attributes" => (object) [
                                    "name" => "RS3",
                                    "pricePerUnit" => 1.13
                                ]
                            ],
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function getCurrencies(): CurrencyApiResponse
    {
        return new CurrencyApiResponse(200, "", (object)[
            "data" => [
                (object)[ "id" => 1, "attributes" => (object)["name" => "Euro", "code" => "EUR", "rate" => 1, "symbol" => "€"] ],
                (object)[ "id" => 2, "attributes" => (object)["name" => "Dollar", "code" => "USD", "rate" => 0.90, "symbol" => "$" ] ],
            ]
        ]);
    }

    public function getPaymentMethods(): PaymentOptionApiResponse
    {
        return new PaymentOptionApiResponse(200, "", (object)[
            "data" => [
                (object)[
                    "id" => 1,
                    "type" => "paymentProviderPaymentMethod",
                    "attributes" => (object)[ "fee" => 0 ],
                    "relationships" => (object)[
                        "paymentMethod" => (object)[ "id" => 1, "type" => "paymentMethod", "attributes" => (object)[ "name" => "Bancontact" ]],
                        "paymentProvider" => (object)[ "id" => 1, "type" => "paymentProvider", "attributes" => (object)[ "name" => "G2A" ]],
                    ]
                ],
                (object)[
                    "id" => 2,
                    "type" => "paymentProviderPaymentMethod",
                    "attributes" => (object)[ "fee" => 0.15 ],
                    "relationships" => (object)[
                        "paymentMethod" => (object)[ "id" => 2, "type" => "paymentMethod", "attributes" => (object)[ "name" => "Visa" ]],
                        "paymentProvider" => (object)[ "id" => 1, "type" => "paymentProvider", "attributes" => (object)[ "name" => "G2A" ]],
                    ]
                ],
                (object)[
                    "id" => 3,
                    "type" => "paymentProviderPaymentMethod",
                    "attributes" => (object)[ "fee" => 0 ],
                    "relationships" => (object)[
                        "paymentMethod" => (object)[ "id" => 1, "type" => "paymentMethod", "attributes" => (object)[ "name" => "Bancontact" ]],
                        "paymentProvider" => (object)[ "id" => 2, "type" => "paymentProvider", "attributes" => (object)[ "name" => "Terminal 3" ]],
                    ]
                ],
                (object)[
                    "id" => 4,
                    "type" => "paymentProviderPaymentMethod",
                    "attributes" => (object)[ "fee" => 0.2 ],
                    "relationships" => (object)[
                        "paymentMethod" => (object)[ "id" => 2, "type" => "paymentMethod", "attributes" => (object)[ "name" => "Visa" ]],
                        "paymentProvider" => (object)[ "id" => 2, "type" => "paymentProvider", "attributes" => (object)[ "name" => "Terminal 3" ]],
                    ]
                ],
                (object)[
                    "id" => 5,
                    "type" => "paymentProviderPaymentMethod",
                    "attributes" => (object)[ "fee" => 0 ],
                    "relationships" => (object)[
                        "paymentMethod" => (object)[ "id" => 3, "type" => "paymentMethod", "attributes" => (object)[ "name" => "WeChat" ]],
                        "paymentProvider" => (object)[ "id" => 3, "type" => "paymentProvider", "attributes" => (object)[ "name" => "WeChat" ]],
                    ]
                ],
                (object)[
                    "id" => 6,
                    "type" => "paymentProviderPaymentMethod",
                    "attributes" => (object)[ "fee" => 0 ],
                    "relationships" => (object)[
                        "paymentMethod" => (object)[ "id" => 4, "type" => "paymentMethod", "attributes" => (object)[ "name" => "Poli" ]],
                        "paymentProvider" => (object)[ "id" => 4, "type" => "paymentProvider", "attributes" => (object)[ "name" => "Poli" ]],
                    ]
                ],
                (object)[
                    "id" => 7,
                    "type" => "paymentProviderPaymentMethod",
                    "attributes" => (object)[ "fee" => 0 ],
                    "relationships" => (object)[
                        "paymentMethod" => (object)[ "id" => 4, "type" => "paymentMethod", "attributes" => (object)[ "name" => "Interact" ]],
                        "paymentProvider" => (object)[ "id" => 4, "type" => "paymentProvider", "attributes" => (object)[ "name" => "Interact" ]],
                    ]
                ],
                (object)[
                    "id" => 8,
                    "type" => "paymentProviderPaymentMethod",
                    "attributes" => (object)[ "fee" => 0.3 ],
                    "relationships" => (object)[
                        "paymentMethod" => (object)[ "id" => 5, "type" => "paymentMethod", "attributes" => (object)[ "name" => "Paysafe card" ]],
                        "paymentProvider" => (object)[ "id" => 5, "type" => "paymentProvider", "attributes" => (object)[ "name" => "Paysafe card" ]],
                    ]
                ]
            ]
        ]);
    }

    public function getReviews(int $page = 0): ReviewApiResponse
    {
        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = (object)[
                "id" => $i,
                "attributes" => (object)[
                    "nickname" => fake()->name(),
                    "rating" => fake()->numberBetween(1,5),
                    "content" => fake()->realText(fake()->numberBetween(50,400)),
                    "date" => fake()->dateTime()->format('Y-m-d H:i:s')
                ]
            ];
        }

        return new ReviewApiResponse(0, 0,200, "", (object)[
            "data" => $data
        ]);
    }

    public function login(string $email, string $password): LoginApiResponse
    {
        $token = fake()->uuid();
        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', (object)[
            "data" => (object) [
                "type" => "user",
                "attributes" => (object) [
                    "username" => fake()->email(),
                    "token" => $token,
                    "firstName" => fake()->firstName(),
                    "lastName" => fake()->lastName(),
                    "marketingOptIn" => fake()->boolean()
                ]
            ]
        ]);
    }

    public function sendEmailConfirmationMail(string $email, string $emailConfirmationUrl): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function setNewPassword(string $email, string $password): LoginApiResponse
    {
        $token = fake()->uuid();
        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', (object)[
            "data" => (object) [
                "type" => "user",
                "attributes" => (object) [
                    "username" => fake()->email(),
                    "token" => $token,
                    "firstName" => fake()->firstName(),
                    "lastName" => fake()->lastName(),
                    "marketingOptIn" => fake()->boolean()
                ]
            ]
        ]);
    }

    public function register(string $email, string $password, string $emailConfirmationUrl, string $firstName, string $lastName = null): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function requestNewPassword(string $email, string $redirectUrl): BaseApiResponse {
        return new BaseApiResponse();
    }
}
