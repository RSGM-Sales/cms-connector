<?php

namespace RSGMSales\Connector\Contracts;

use RSGMSales\Connector\Dto\CreateOrderData;
use RSGMSales\Connector\Dto\CreateReviewData;
use RSGMSales\Connector\Dto\UserPreferencesData;
use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

interface UserApiInterface
{
    public function createReview(CreateReviewData $feedbackData): BaseApiResponse;
    public function createOrder(CreateOrderData $orderData): BaseApiResponse;
    public function getOrderHistory(int $page = 0): BaseApiResponse;
    public function logout(): BaseApiResponse;
    public function updateProfile(UserPreferencesData $profileData): LoginApiResponse;
}
