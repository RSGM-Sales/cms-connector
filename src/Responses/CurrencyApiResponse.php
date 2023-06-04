<?php

namespace RSGMSales\Connector\Responses;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use RSGMSales\Connector\Dto\Currency;

class CurrencyApiResponse extends BaseApiResponse
{
    public function __construct(int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        parent::__construct($statusCode, $reasonPhrase, $body);
    }

    public static function create(ResponseInterface $response): CurrencyApiResponse
    {
        $instance = new CurrencyApiResponse($response->getStatusCode(), $response->getReasonPhrase(), json_decode($response->getBody()->getContents()));
        $instance->response = $response;
        return $instance;
    }

    /**
     * @return Currency[]
     */
    public function currencies(): array {
        return Currency::Deserialize($this->body->data);
    }
}
