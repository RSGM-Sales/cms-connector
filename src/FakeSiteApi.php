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
        $token = $data['token']?? '::TOKEN::';

        session(['user-api-token' => $token]);

        return new LoginApiResponse(200, '', (object)[
            "data" => (object)[
                "type" => "user",
                "attributes" => (object)[
                    "username" => '::USERNAME::',
                    "email" => '::EMAIL::',
                    "token" => $token,
                    "firstName" => '::FIRST_NAME::',
                    "lastName" => '::LAST_NAME::',
                    "marketingOptIn" => true
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
        return $this->login('::TOKEN::');
    }

    public function register(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function requestNewPassword(mixed $data): BaseApiResponse
    {
        return new BaseApiResponse();
    }

    public function getCoupon(mixed $data): BaseApiResponse {
        return new BaseApiResponse();
    }
}
