<?php

namespace RSGMSales\Connector;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RSGMSales\Connector\Dto\ApiUser;

class UserApi extends BaseApi
{
    protected function client(string $method, string $url, array $data = []): Response
    {
        /** @var ?ApiUser $user */
        $user = Session::get('user');

        if (! $user instanceof ApiUser) {
            throw new \RuntimeException('User is not logged in or session is corrupted.');
        }

        $request = Http::withHeaders([
            'Authorization' => "Bearer $user->token",
            'Site-Id' => config('connector.site.id'),
            'User-IP' => $this->getUserIPAddress(),
            'Content-Type' => 'application/json'
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

        if ($response->ok() && ($response->json('data.type') === 'user')) {
            Session::put('user', ApiUser::fromResponse($response->json()));
        }

        if ($response->ok() && Str::contains($fullUrl, 'logout')) {
            Session::forget('user');
        }

        return $response;
    }
}
