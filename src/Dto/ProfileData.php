<?php

namespace RSGMSales\Connector\Dto;

class ProfileData
{
    public bool $marketingOptIn;
    public string $oldPassword;
    public string $newPassword;
    public string $oldUsername;
    public string $newUsername;

    public function __construct(bool $marketingOptIn = null, string $oldPassword = null, string $newPassword = null, string $oldUsername = null, string $newUsername = null)
    {
        $this->marketingOptIn = $marketingOptIn;
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
        $this->oldUsername = $oldUsername;
        $this->newUsername = $newUsername;
    }
}
