<?php

namespace RSGMSales\Connector;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as ResponseFacade;
use RSGMSales\Connector\Contracts\ApiInterface;

class FakeApi implements ApiInterface
{
    public function get(string $url, array $params = []): Response
    {
        return ResponseFacade::make(['message' => 'Fake GET response']);
    }

    public function post(string $url, array $params = []): Response
    {
        return ResponseFacade::make(['message' => 'Fake POST response']);
    }

    public function put(string $url, array $params = []): Response
    {
        return ResponseFacade::make(['message' => 'Fake PUT response']);
    }

    public function patch(string $url, array $params = []): Response
    {
        return ResponseFacade::make(['message' => 'Fake PATCH response']);
    }

    public function delete(string $url, array $params = []): Response
    {
        return ResponseFacade::make(['message' => 'Fake DELETE response']);
    }
}
