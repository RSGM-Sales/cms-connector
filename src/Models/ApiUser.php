<?php

namespace RSGMSales\Connector\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ApiUser extends Authenticatable
{

    private string $username;
    private string $token;

    public function __construct(string $username, string $token)
    {
        $this->username = $username;
        $this->token = $token;
    }

    public function username(): string {
        return $this->username;
    }

    public function token(): string {
        return $this->token;
    }
}
