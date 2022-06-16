<?php

namespace Omdb;

use JsonException;
use Omdb\Api\Api;
use Omdb\Api\ApiFactory;
use Omdb\Value\ImdbId;
use Omdb\Value\Title;
use Omdb\Value\Year;

/**
 * Main class for using Omdb api
 */
class Omdb
{
    private string $apiKey;
    private array $params;
    private Api $api;

    /**
     * @param string $apiKey
     * @param Api|null $api
     */
    public function __construct(string $apiKey, ?Api $api = null)
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
    }

    /**
     * @param string|int $year
     * @return void
     */
    public function year($year)
    {
        $this->params['year'] = Year::fromString($year);
    }

    /**
     * @param string $imdb
     * @return void
     */
    public function imdb(string $imdb)
    {
        $this->params['imdb'] = ImdbId::fromString($imdb);
    }

    /**
     * @param array|string|null $params
     * @return mixed
     * @throws JsonException
     */
    public function search($params)
    {
        if (!empty($params) && is_string($params)) {
            $this->params['title'] = Title::fromString($params);
        }
        $searchParams = array_merge($this->params, ['apiKey' => $this->apiKey]);
        return $this->api->search($searchParams);
    }
}
