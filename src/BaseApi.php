<?php

declare(strict_types=1);

namespace RSGMSales\Connector;

use Illuminate\Http\Response;
use RSGMSales\Connector\Contracts\ApiInterface;
use RSGMSales\Connector\Traits\GetUserIpAddress;

abstract class BaseApi implements ApiInterface
{
    use GetUserIpAddress;

    abstract protected function client(string $method, string $url, array $data = []): Response;

    public function get(string $url, array $params = []): Response
    {
        return $this->client('get', $url, $params);
    }

    public function post(string $url, array $params = []): Response
    {
        return $this->client('post', $url, $params);
    }

    public function patch(string $url, array $params = []): Response
    {
        return $this->client('patch', $url, $params);
    }

    public function put(string $url, array $params = []): Response
    {
        return $this->client('put', $url, $params);
    }

    public function delete(string $url, array $params = []): Response
    {
        return $this->client('delete', $url, $params);
    }
}