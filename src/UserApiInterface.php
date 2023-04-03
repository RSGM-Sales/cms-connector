<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Models\BaseApiResponse;
use RSGMSales\Connector\Models\OrderData;
use RSGMSales\Connector\Models\ProfileData;

interface UserApiInterface
{
    public function changeEmail(string $email): BaseApiResponse;
    public function requestNewPassword(): BaseApiResponse;
    public function createOrder(OrderData $orderData): BaseApiResponse;
    public function getOrderHistory(): BaseApiResponse;
    public function updateProfile(ProfileData $profileData): BaseApiResponse;
}
