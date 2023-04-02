<?php

namespace RSGMSales\Connector;

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;

/**
 * @property array $body
 * @property string $reasonPhrase
 * @property int $statusCode
 */
class ApiResponse
{
    public Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getBody() {
        return json_decode($this->response->getBody()->getContents());
    }

    public function __get($key)
    {
        return match ($key) {
            'body' => $this->getBody(),
            'reasonPhrase' => $this->response->getReasonPhrase(),
            'statusCode' => $this->response->getStatusCode(),
            default => null,
        };

    }
}
