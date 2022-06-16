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
        $url = http_build_query($params);
        $response = $this->httpClient->getRequest(self::BASE_URL . "?" . $url);
        if (empty($response)) {
            throw new \RuntimeException("Fetched empty response");
        }
        $result = json_decode($response, true, 521, JSON_THROW_ON_ERROR);
        return $result;
    }
}
