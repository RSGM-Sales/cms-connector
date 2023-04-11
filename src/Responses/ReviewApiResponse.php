<?php

namespace RSGMSales\Connector\Responses;

use GuzzleHttp\Psr7\Response;
use RSGMSales\Connector\Dto\Review;

class ReviewApiResponse extends  BaseApiResponse
{
    public function __construct(int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        parent::__construct($statusCode, $reasonPhrase, $body);
    }

    public static function create(Response $response): ReviewApiResponse
    {
        $instance = new ReviewApiResponse($response->getStatusCode(), $response->getReasonPhrase(), json_decode($response->getBody()->getContents()));
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
