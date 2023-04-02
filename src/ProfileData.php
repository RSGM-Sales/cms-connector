<?php

namespace RSGMSales\Connector;

class ProfileData
{
    public bool $marketingOptIn;

    public function __construct(bool $marketingOptIn = true)
    {
        $this->marketingOptIn = $marketingOptIn;
    }
}
