<?php

namespace RSGMSales\Connector\Dto;

class UserPreferencesData
{
    public bool $marketingOptIn;
    public string $email;

    public function __construct(bool $marketingOptIn, string $email)
    {
        $this->marketingOptIn = $marketingOptIn;
        $this->email = $email;
    }

    public static function create(bool $marketingOptIn, string $email): UserPreferencesData {
        return new UserPreferencesData($marketingOptIn, $email);
    }
}
