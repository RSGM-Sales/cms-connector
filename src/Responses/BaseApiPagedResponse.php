<?php

namespace RSGMSales\Connector\Responses;

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
}
