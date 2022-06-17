<?php

declare(strict_types=1);

namespace Omdb;

use JsonException;
use Omdb\Api\Api;
use Omdb\Api\ApiFactory;
use Omdb\Api\ApiInterface;
use Omdb\Api\Exception\ApiException;
use Omdb\Api\Exception\ParamsException;
use Omdb\Value\ImdbId;
use Omdb\Value\Search;
use Omdb\Value\Title;
use Omdb\Value\Year;

/**
 * Main class for using Omdb api
 */
class Omdb
{
    private string $apiKey;
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
        $this->apiKey = $apiKey;
        $this->api = $api ?? (new ApiFactory())->make();
    }

    public function title(string $title)
    {
        $this->params['title'] = Title::fromString($title);
        return $this;
    }

    /**
     * @param string|int $year
     */
    public function year($year)
    {
        $this->params['year'] = Year::fromString($year);
        return $this;
    }

    /**
     * @param string $imdb
     * @return Omdb
     */
    public function imdb(string $imdb)
    {
        $this->params['imdb'] = ImdbId::fromString($imdb);
        return $this;
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
        }
        $searchParams = array_merge($this->params, ['apikey' => $this->apiKey]);
        return $this->api->search($searchParams);
    }
}
