<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Models\BaseApiResponse;

interface SiteApiInterface
{
    public function getCurrencies(): BaseApiResponse;
    public function getPaymentMethods(): BaseApiResponse;
    public function getReviews(): BaseApiResponse;
    public function login(string $username, string $password): BaseApiResponse;
    public function register(string $username, string $password, string $name): BaseApiResponse;
}
