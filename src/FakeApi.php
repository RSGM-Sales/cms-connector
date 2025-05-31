<?php

namespace RSGMSales\Connector;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use RSGMSales\Connector\Contracts\ApiInterface;

class FakeApi implements ApiInterface
{
    public function get(string $url, array $params = []): Response
    {
        return Http::response(['message' => 'Fake GET response'], 200);
    }

    public function post(string $url, array $params = []): Response
    {
        return Http::response(['message' => 'Fake POST response'], 200);
    }

    public function put(string $url, array $params = []): Response
    {
        return Http::response(['message' => 'Fake PUT response'], 200);
    }

    public function patch(string $url, array $params = []): Response
    {
        return Http::response(['message' => 'Fake PATCH response'], 200);
    }

    public function delete(string $url, array $params = []): Response
    {
        return Http::response(['message' => 'Fake DELETE response'], 200);
    }
}
