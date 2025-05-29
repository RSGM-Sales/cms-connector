<?php

namespace RSGMSales\Connector\Contracts;

use Illuminate\Http\Response;

interface ApiInterface
{
    public function get(string $url, array $params = []): Response;

    public function post(string $url, array $params = []): Response;

    public function put(string $url, array $params = []): Response;

    public function patch(string $url, array $params = []): Response;

    public function delete(string $url, array $params = []): Response;
}
