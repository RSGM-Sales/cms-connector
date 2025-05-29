<?php

namespace RSGMSales\Connector\Dto;

use Illuminate\Support\Arr;

readonly class ApiUser
{
    public function __construct(
        public string  $email,
        public string  $token,
        public bool    $marketingOptIn,
        public string  $firstName,
        public ?string $lastName = null,
    ) {
    }

    public static function fromResponse(array $response): self
    {
        return new self(
            email: Arr::get($response, 'data.attributes.email'),
            token: Arr::get($response, 'data.attributes.token'),
            marketingOptIn: Arr::get($response, 'data.attributes.marketingOptIn'),
            firstName: Arr::get($response, 'data.attributes.firstName'),
            lastName: Arr::get($response, 'data.attributes.lastName'),
        );
    }
}
