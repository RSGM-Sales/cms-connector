<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Models\BaseApiResponse;

class FakeSiteApi implements SiteApiInterface
{
    private function createResponse(mixed $body): BaseApiResponse
    {
        return new BaseApiResponse(200, "", $body);
    }

    public function getCurrencies(): BaseApiResponse
    {
        return $this->createResponse([
            "data" => [
                (object)[ "id" => 1, "name" => "Euro", "code" => "EUR", "rate" => 1.5 ],
                (object)[ "id" => 2, "name" => "Dollar", "code" => "USD", "rate" => 2 ],
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

    public function login(string $username, string $password): BaseApiResponse
    {
        return $this->createResponse([
            "username" => fake()->name(),
            "token" => fake()->uuid()
        ]);
    }

    public function register(string $username, string $password, string $name): BaseApiResponse
    {
        return $this->createResponse([
            "username" => $name,
            "token" => fake()->uuid()
        ]);
    }
}
