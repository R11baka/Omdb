<?php

declare(strict_types=1);

namespace Omdb\Api;

use Omdb\Api\Exception\ApiException;
use Omdb\Api\HttpClient\Client;
use Omdb\Api\Response\Movie;

class Api implements ApiInterface
{
    private Client $httpClient;
    private ParamsConverter $converter;
    const BASE_URL = 'https://www.omdbapi.com/';
    private string $apiKey;

    public function __construct(Client $httpClient, string $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->converter = new ParamsConverter();
        $this->apiKey = $apiKey;
    }

    /**
     * @param $params
     * @return mixed
     * @throws \JsonException
     * @throws \Omdb\Api\Exception\ApiException
     * @throws \Omdb\Api\Exception\ParamsException
     */
    public function search($params)
    {
        $params = $this->converter->convert($params);
        $params = array_merge($params, ['apikey' => $this->apiKey]);
        $url = self::BASE_URL . "?" . http_build_query($params);
        $response = $this->httpClient->getRequest($url);
        if (empty($response)) {
            throw new \RuntimeException("Fetched empty response");
        }
        $result = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        if (!isset($result['Response'])) {
            throw new \RuntimeException("Incorrect response:" . json_encode($response));
        }
        if ($result['Response'] == 'False' && isset($result['Error'])) {
            throw new ApiException($result['Error']);
        }
        return $result;
    }
}
