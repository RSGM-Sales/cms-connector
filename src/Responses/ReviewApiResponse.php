<?php

namespace RSGMSales\Connector\Responses;

use GuzzleHttp\Psr7\Response;
use RSGMSales\Connector\Dto\Review;

class ReviewApiResponse extends  BaseApiPagedResponse
{
    public function __construct(int $currentPage, int $totalPages, int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        parent::__construct($currentPage, $totalPages, $statusCode, $reasonPhrase, $body);
    }

    public static function create(Response $response): ReviewApiResponse
    {
        $instance = new ReviewApiResponse(0, 0, $response->getStatusCode(), $response->getReasonPhrase(), json_decode($response->getBody()->getContents()));
        $instance->response = $response;
        return $instance;
    }

    /**
     * @return Review[]
     */
    public function reviews(): array {
        return Review::Deserialize($this->body->data);
    }
}
