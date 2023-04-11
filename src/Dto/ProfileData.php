<?php

namespace RSGMSales\Connector\Dto;

class ProfileData
{
    public bool $marketingOptIn;

    public function __construct(bool $marketingOptIn = true)
    {
        $this->marketingOptIn = $marketingOptIn;
    }
}
