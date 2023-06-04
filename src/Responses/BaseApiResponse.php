<?php

namespace RSGMSales\Connector\Responses;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * @property array $body
 * @property string $reasonPhrase
 * @property int $statusCode
 */
class BaseApiResponse
{
    public ResponseInterface $response;

    public mixed $body;
    public int $statusCode;
    public string $reasonPhrase;

    public function __construct(int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        $this->statusCode = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
        $this->body = $body;
    }

    public static function create(ResponseInterface $response): BaseApiResponse {
        $instance = new BaseApiResponse($response->getStatusCode(), $response->getReasonPhrase(), json_decode($response->getBody()->getContents()));
        $instance->response = $response;
        return $instance;
    }
}
