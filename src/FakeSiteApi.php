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
        return new BaseApiResponse(200, '', [
            "data" => (object)[
                "type" => "coupon",
                "id" => 1,
                "attributes" => (object)[
                    "code" => '::CODE::',
                    "amount" => 100,
                ]
            ]
        ]);
    }

    public function getPriceCalculation(mixed $data): BaseApiResponse {
        return new BaseApiResponse(200, '', [
            "data" => (object)  [
                'currency' => [
                    'id' => 1,
                    'iso_code' => 'EUR',
                    'rate' => 1.0,
                ],
                'amount_to_pay' => [
                    'fee' => 0,
                    'excluding_fees' => 10.0,
                    'including_fees' => 10.0,
                ],
                'coupon' => [
                    'id' => 1,
                    'code' => 'get2',
                    'percentage' => 2,
                ],
                'amount_to_receive' => [
                    'without_coupon' => 100.0,
                    'with_coupon' => 100.0,
                ],
            ]);
    }
}
