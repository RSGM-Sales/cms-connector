<?php

namespace RSGMSales\Connector\Responses;

use RSGMSales\Connector\Dto\ApiUser;

class BaseApiPagedResponse extends BaseApiResponse
{

    public int $currentPage;
    public int $totalPages;

    public function __construct(int $currentPage, int $totalPages, int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        parent::__construct($statusCode, $reasonPhrase, $body);

        $this->currentPage = $currentPage;
        $this->totalPages = $totalPages;
    }

    public static function deserialize(mixed $data): ApiUser {
        return ApiUser::create($data->attributes->email, $data->attributes->token, $data->attributes->marketingOptIn, $data->attributes->firstName, $data->attributes->lastName);
    }
}
