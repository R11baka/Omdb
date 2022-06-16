<?php

namespace Omdb\Api;

use Omdb\Api\HttpClient\CurlClient;

class ApiFactory
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
    }

    public function make(): Api
    {
        $client = new CurlClient();
        return new Api($client);
    }

}
