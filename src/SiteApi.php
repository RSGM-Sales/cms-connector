<?php

declare(strict_types=1);

namespace RSGMSales\Connector;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RSGMSales\Connector\Dto\ApiUser;

class SiteApi extends BaseApi
{
    protected function client(string $method, string $url, array $data = []): Response
    {
        $request = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(config('connector.site.username') . ':' . config('connector.site.password')),
            'Site-Id' => config('connector.site.id'),
            'User-IP' => $this->getUserIPAddress(),
            'Content-Type' => 'application/json',
        ]);

        $fullUrl = config('connector.apiBaseUrl') . $url;

        $response = match (strtolower($method)) {
            'get' => $request->get($fullUrl, $data),
            'post' => $request->post($fullUrl, $data),
            'put' => $request->put($fullUrl, $data),
            'patch' => $request->patch($fullUrl, $data),
            'delete' => $request->delete($fullUrl, $data),
            default => throw new \InvalidArgumentException("Unsupported HTTP method: $method"),
        };

        if ($response->ok() && ($response->json('data.type.user'))) {
            Session::put('user', ApiUser::fromResponse($response->json()));
        }

        return $response;
    }
}