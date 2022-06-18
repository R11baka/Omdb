<?php

declare(strict_types=1);

namespace Omdb;

use JsonException;
use Omdb\Api\Api;
use Omdb\Api\ApiFactory;
use Omdb\Api\ApiInterface;
use Omdb\Api\Exception\ApiException;
use Omdb\Api\Exception\ParamsException;
use Omdb\Search\ImdbIdSearch;
use Omdb\Search\TitleSearch;
use Omdb\Value\Search;

/**
 * Main class for using Omdb api
 */
class Omdb
{
    private array $params;
    private ApiInterface $api;

    /**
     * @param string $apiKey
     * @param Api|null $api
     */
    public function __construct(string $apiKey, ?ApiInterface $api = null)
    {
        if (empty($apiKey)) {
            throw new \InvalidArgumentException("Provide not empty apiKey");
        }
        $this->api = $api ?? (new ApiFactory($apiKey))->make();
    }

    public function title(string $title): TitleSearch
    {
        return new TitleSearch($title, $this->api);
    }

    /**
     * @param string $imdb
     * @return ImdbIdSearch
     */
    public function imdb(string $imdb): ImdbIdSearch
    {
        return new ImdbIdSearch($imdb, $this->api);
    }

    /**
     * @param array|string|null $params
     * @return mixed
     * @throws ApiException
     * @throws ParamsException
     * @throws JsonException
     */
    public function search($params = '')
    {
        if (!empty($params) && is_string($params)) {
            $this->params['search'] = Search::fromString($params);
            $baseSearch = new \Omdb\Search\Search($params, $this->api);
            return $baseSearch->search();
        }
    }
}
