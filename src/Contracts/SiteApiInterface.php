<?php

namespace RSGMSales\Connector\Contracts;

use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

interface SiteApiInterface
{
    public function confirmEmail(mixed $data): BaseApiResponse;
    public function getGames(): BaseApiResponse;
    public function getCurrencies(): BaseApiResponse;
    public function getPaymentMethods(): BaseApiResponse;
    public function getReviews(mixed $data): BaseApiResponse;
    public function login(mixed $data): LoginApiResponse;
    public function register(mixed $data): BaseApiResponse;
    public function requestNewPassword(mixed $data): BaseApiResponse;
    public function sendEmailConfirmationMail(mixed $data): BaseApiResponse;
    public function setNewPassword(mixed $data): LoginApiResponse;
}
