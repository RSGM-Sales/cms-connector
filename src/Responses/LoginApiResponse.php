<?php

namespace RSGMSales\Connector\Responses;

use GuzzleHttp\Psr7\Response;
use RSGMSales\Connector\Dto\ApiUser;

class LoginApiResponse extends BaseApiResponse
{
    public function __construct(int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        parent::__construct($statusCode, $reasonPhrase, $body);
    }

    public static function create(Response $response): LoginApiResponse {
        $instance = new LoginApiResponse($response->getStatusCode(), $response->getReasonPhrase(), json_decode($response->getBody()->getContents()));
        $instance->response = $response;
        return $instance;
    }

    public function user(): ApiUser {
        return ApiUser::deserialize($this->body->data);
    }
}
