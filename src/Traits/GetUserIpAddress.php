<?php

namespace RSGMSales\Connector\Traits;

trait GetUserIpAddress
{
    protected function getUserIPAddress(): string {
        // It's possible that the user IP address is hidden inside a CloudFlare header
        // So we're going to see if the IP address is there first, before getting the default IP from the request
        $cloudflareUserIP = request()->header('CF-Connecting-IP');

        return $cloudflareUserIP ?? request()->ip();
    }
}