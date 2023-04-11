<?php

namespace RSGMSales\Connector\Responses;

use GuzzleHttp\Psr7\Response;
use RSGMSales\Connector\Dto\PaymentOption;

class PaymentOptionApiResponse extends BaseApiResponse
{
    public function __construct(int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        parent::__construct($statusCode, $reasonPhrase, $body);
    }

    public static function create(Response $response): PaymentOptionApiResponse
    {
        $instance = new PaymentOptionApiResponse($response->getStatusCode(), $response->getReasonPhrase(), json_decode($response->getBody()->getContents()));
        $instance->response = $response;
        return $instance;
    }

    /**
     * @return PaymentOption[]
     */
    public function paymentOptions(): array
    {
        return PaymentOption::Deserialize($this->body->data);
    }
}