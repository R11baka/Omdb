<?php

declare(strict_types=1);

namespace Omdb;

use JsonException;
use Omdb\Api\Api;
use Omdb\Api\Exception\OmdbException;
use Omdb\Api\ApiFactory;
use Omdb\Api\ApiInterface;
use Omdb\Api\Exception\ApiException;
use Omdb\Api\Exception\ParamsException;
use Omdb\Api\Response\SearchResult;
use Omdb\Search\ImdbIdSearch;
use Omdb\Search\SearchFactory;
use Omdb\Search\TitleSearch;

/**
 * Main class for using Omdb api
 */
class Omdb
{
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
     * @param array|string $params
     * @return array<SearchResult>
     * @throws ApiException
     * @throws ParamsException
     * @throws JsonException
     * @throws OmdbException
     */
    public function search($params)
    {
        if (empty($params)) {
            throw new \InvalidArgumentException("Provide not empty search string");
        }
        $factory = new SearchFactory($this->api);
        $search = $factory->make($params);
        return $search->search();
    }
}
