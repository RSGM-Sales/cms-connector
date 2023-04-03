<?php

namespace RSGMSales\Connector\Models;

use GuzzleHttp\Psr7\Response;

/**
 * @property array $body
 * @property string $reasonPhrase
 * @property int $statusCode
 */
class BaseApiResponse
{
    public Response $response;

    public mixed $body;
    public int $statusCode;
    public string $reasonPhrase;

    public function __construct(int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        $this->statusCode = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
        $this->body = $body;
    }

    public static function create(Response $response): BaseApiResponse {
        $instance = new BaseApiResponse($response->getStatusCode(), $response->getReasonPhrase(), $response->getBody()->getContents());
        $instance->response = $response;
        return $instance;
    }
}
