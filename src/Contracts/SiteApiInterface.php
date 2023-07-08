<?php

namespace RSGMSales\Connector\Contracts;

use RSGMSales\Connector\Responses\BaseApiResponse;
use RSGMSales\Connector\Responses\LoginApiResponse;

interface SiteApiInterface
{
    public function confirmEmail(string $email): BaseApiResponse;
    public function getGames(): BaseApiResponse;
    public function getCurrencies(): BaseApiResponse;
    public function getPaymentMethods(): BaseApiResponse;
    public function getReviews(int $page = 0): BaseApiResponse;
    public function login(string $email, string $password): LoginApiResponse;
    public function register(string $email, string $password, string $emailConfirmationUrl, string $firstName, string $lastName = null): BaseApiResponse;
    public function requestNewPassword(string $email, string $redirectUrl): BaseApiResponse;
    public function sendEmailConfirmationMail(string $email, string $emailConfirmationUrl): BaseApiResponse;
    public function setNewPassword(string $email, string $password): LoginApiResponse;
}
