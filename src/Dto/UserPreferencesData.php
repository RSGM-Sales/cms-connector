<?php

namespace RSGMSales\Connector\Dto;

class UserPreferencesData
{
    public bool $marketingOptIn;
    public string $oldUsername;
    public string $newUsername;

    public function __construct(bool $marketingOptIn = null, string $oldUsername = null, string $newUsername = null)
    {
        $this->marketingOptIn = $marketingOptIn;
        $this->oldUsername = $oldUsername;
        $this->newUsername = $newUsername;
    }
}
