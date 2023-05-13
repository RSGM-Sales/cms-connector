<?php

namespace RSGMSales\Connector\Dto;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ApiUser extends Authenticatable
{
    public string $email;
    public ?string $firstName;
    public ?string $lastName;
    public bool $marketingOptIn;
    private string $token;

    public function __construct(string $email, string $token, string $marketingOptIn, string $firstName = null, string $lastName = null)
    {
        $this->email = $email;
        $this->token = $token;
        $this->marketingOptIn = $marketingOptIn;
        $this->firstName = $firstName;
        $this->lastName = $lastName;

        parent::__construct();
    }

    public function token(): string {
        return $this->token;
    }

    public static function create(string $email, string $token, string $marketingOptIn, string $firstName = null, string $lastName = null): ApiUser {
        return new ApiUser($email, $token, $marketingOptIn, $firstName, $lastName);
    }

    public static function deserialize(mixed $data): ApiUser {
        return ApiUser::create($data->attributes->email, $data->attributes->token, $data->attributes->marketingOptIn, $data->attributes->firstName, $data->attributes->lastName);
    }
}
