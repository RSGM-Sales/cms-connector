<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Models\BaseApiResponse;
use RSGMSales\Connector\Models\LoginApiResponse;

interface SiteApiInterface
{
    public function getGames(): BaseApiResponse;
    public function getCurrencies(): BaseApiResponse;
    public function getPaymentMethods(): BaseApiResponse;
    public function getReviews(): BaseApiResponse;
    public function login(string $username, string $password): LoginApiResponse;
    public function register(string $username, string $password, string $name): LoginApiResponse;
}
