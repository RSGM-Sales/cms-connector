<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\CurrencyApiResponse;
use RSGMSales\Connector\Responses\GameApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

interface SiteApiInterface
{
    public function getGames(): GameApiResponse;
    public function getCurrencies(): CurrencyApiResponse;
    public function getPaymentMethods(): BaseApiResponse;
    public function getReviews(): BaseApiResponse;
    public function login(string $username, string $password): LoginApiResponse;
    public function register(string $username, string $password, string $name): LoginApiResponse;
}
