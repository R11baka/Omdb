<?php

declare(strict_types=1);

namespace Omdb\Api;

use Omdb\Api\HttpClient\CurlClient;

class ApiFactory
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function make(): ApiInterface
    {
        $client = new CurlClient();
        return new Api($client, $this->apiKey);
    }
}
