<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Dto\OrderData;
use RSGMSales\Connector\Dto\ProfileData;
use RSGMSales\Connector\Responses\BaseApiResponse;

interface UserApiInterface
{
    public function changeEmail(string $email): BaseApiResponse;
    public function requestNewPassword(): BaseApiResponse;
    public function createOrder(OrderData $orderData): BaseApiResponse;
    public function getOrderHistory(): BaseApiResponse;
    public function updateProfile(ProfileData $profileData): BaseApiResponse;
}
