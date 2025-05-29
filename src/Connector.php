<?php

namespace RSGMSales\Connector;

use RSGMSales\Connector\Contracts\ApiInterface;

class Connector
{
    public function __construct(
        public readonly ApiInterface $siteApi,
        public readonly ApiInterface $userApi
    ) {}

    public function siteApi(): ApiInterface
    {
        return $this->siteApi;
    }

    public function userApi(): ApiInterface
    {
        return $this->userApi;
    }

    public static function fake(): self
    {
        $fakeApi = new FakeApi;

        return new self($fakeApi, $fakeApi);
    }
}