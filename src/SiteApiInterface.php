<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\CurrencyApiResponse;
use RSGMSales\Connector\Responses\GameApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;
use RSGMSales\Connector\Responses\PaymentOptionApiResponse;
use RSGMSales\Connector\Responses\ReviewApiResponse;

interface SiteApiInterface
{
    public function getGames(): GameApiResponse;
    public function getCurrencies(): CurrencyApiResponse;
    public function getPaymentMethods(): PaymentOptionApiResponse;
    public function getReviews(int $page = 0): ReviewApiResponse;
    public function login(string $email, string $password): LoginApiResponse;
    public function register(string $email, string $password, string $firstName = null, string $lastName = null): BaseApiResponse;
    public function requestNewPassword(string $email, string $redirectUrl): BaseApiResponse;
    public function setNewPassword(string $email, string $password): LoginApiResponse;
}
