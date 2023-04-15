<?php

namespace RSGMSales\Connector\Responses;

use GuzzleHttp\Psr7\Response;
use RSGMSales\Connector\Dto\Order;

class OrderHistoryApiResponse extends BaseApiResponse
{
    public int $currentpage;
    public int $totalPages;

    public function __construct(int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        parent::__construct($statusCode, $reasonPhrase, $body);
    }

    public static function create(Response $response): OrderHistoryApiResponse
    {
        $instance = new OrderHistoryApiResponse($response->getStatusCode(), $response->getReasonPhrase(), json_decode($response->getBody()->getContents()));
        $instance->response = $response;
        return $instance;
    }

    /**
     * @return Order[]
     */
    public function orders(): array {
        return Order::Deserialize($this->body->data);
    }

}
