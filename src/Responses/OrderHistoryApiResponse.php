<?php

namespace RSGMSales\Connector\Responses;

use GuzzleHttp\Psr7\Response;
use RSGMSales\Connector\Dto\Order;

class OrderHistoryApiResponse extends BaseApiPagedResponse
{
    public function __construct(int $currentPage, int $totalPages, int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        parent::__construct($currentPage, $totalPages, $statusCode, $reasonPhrase, $body);
    }

    public static function create(Response $response): OrderHistoryApiResponse
    {
        $instance = new OrderHistoryApiResponse(0, 0, $response->getStatusCode(), $response->getReasonPhrase(), json_decode($response->getBody()->getContents()));
        $instance->response = $response;
        $instance->currentPage = $instance->body->meta->current_page;
        $instance->totalPages = $instance->body->meta->last_page;
        return $instance;
    }

    /**
     * @return Order[]
     */
    public function orders(): array {
        return Order::Deserialize($this->body->data);
    }

}
