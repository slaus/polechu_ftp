<?php

namespace App\Services\BeeFlyTour;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class BeeFlyTourApi
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly string $token
    ) {}

    public function get(array $params): array
    {
        $response = $this->request()->get(trim($this->baseUrl, '/') . '?' . http_build_query(array_merge($params, ['oauth_token' => $this->token])));

        return $response->json();
    }

    private function request(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl);
    }
}
