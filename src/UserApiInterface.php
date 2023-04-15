<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Dto\OrderData;
use RSGMSales\Connector\Dto\UserPreferencesData;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;
use RSGMSales\Connector\Responses\OrderHistoryApiResponse;

interface UserApiInterface
{
    public function requestNewPassword(string $redirectUrl): BaseApiResponse;
    public function setNewPassword(string $password): LoginApiResponse;
    public function createOrder(OrderData $orderData): BaseApiResponse;
    public function getOrderHistory(): OrderHistoryApiResponse;
    public function updateProfile(UserPreferencesData $profileData): BaseApiResponse;
}
