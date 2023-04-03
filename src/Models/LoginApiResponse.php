<?php

namespace RSGMSales\Connector\Models;

use GuzzleHttp\Psr7\Response;

class LoginApiResponse extends BaseApiResponse
{
    private ApiUser $user;

    public function __construct(int $statusCode = 200, string $reasonPhrase = "", mixed $body = null)
    {
        parent::__construct($statusCode, $reasonPhrase, $body);

        $this->user = new ApiUser($this->body["username"], $this->body["token"]);
    }

    public static function create(Response $response): LoginApiResponse {
        $instance = new LoginApiResponse($response->getStatusCode(), $response->getReasonPhrase(), $response->getBody()->getContents());
        $instance->response = $response;
        $instance->user = new ApiUser($instance->body["username"], $instance->body["token"]);
        return $instance;
    }

    public function user(): ApiUser {
        return $this->user;
    }
}
