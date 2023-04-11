<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\CurrencyApiResponse;
use RSGMSales\Connector\Responses\GameApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

class FakeSiteApi implements SiteApiInterface
{
    private function createResponse(mixed $body): BaseApiResponse
    {
        return new BaseApiResponse(200, "", $body);
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
                    "relationships" => [
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

    public function getPaymentMethods(): BaseApiResponse
    {
        return $this->createResponse([
            "data" => [
                (object)[ "id" => 1, "name" => "Bancontact (Terminal 3)", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 2, "name" => "Bancontact (G2A)", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 3, "name" => "Visa (Terminal 3)", "fee" => 2.5, "icon" => "" ],
                (object)[ "id" => 4, "name" => "Visa (G2A)", "fee" => 2.5, "icon" => "" ],
                (object)[ "id" => 5, "name" => "WeChat", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 6, "name" => "Poli", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 7, "name" => "Interact", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 8, "name" => "Paysafe card", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 9, "name" => "Ideal", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 10, "name" => "sofort", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 11, "name" => "Trustly", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 12, "name" => "GiroPay", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 13, "name" => "Neteller", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 14, "name" => "Skrill", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 15, "name" => "EPS", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 16, "name" => "przelewy24", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 17, "name" => "blik", "fee" => 1, "icon" => "" ],
                (object)[ "id" => 18, "name" => "AliPay", "fee" => 2, "icon" => "" ],
                (object)[ "id" => 19, "name" => "Web money", "fee" => 0, "icon" => "" ],
                (object)[ "id" => 20, "name" => "Mint", "fee" => 0, "icon" => "" ],
            ]
        ]);
    }

    public function getReviews(): BaseApiResponse
    {
        $data = [];
        for ($i = 0; $i < 6; $i++) {
            $data[] = (object)[ "name" => fake()->name(), "rating" => 5, "text" => fake()->realText()];
        }

        return $this->createResponse([
            "data" => $data
        ]);
    }

    public function login(string $username, string $password): LoginApiResponse
    {
        $token = fake()->uuid();
        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', [
            "username" => fake()->name(),
            "token" => $token
        ]);
    }

    public function register(string $username, string $password, string $name): LoginApiResponse
    {
        $token = fake()->uuid();
        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', [
            "username" => $name,
            "token" => $token
        ]);
    }
}
