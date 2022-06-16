<?php

namespace Omdb\Api;

use Omdb\Api\HttpClient\Client;

class Api
{
    private Client $httpClient;
    const BASE_URL = 'https://www.omdbapi.com/';

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function search($params)
    {
        $url = http_build_url(self::BASE_URL, $params);
        $response = $this->httpClient->getRequest($url);
        if (empty($response)) {
            throw new \RuntimeException("Fetched empty response");
        }
        $result = json_decode($response, true);
        return $result;
    }
}
