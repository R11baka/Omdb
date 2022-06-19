<?php

namespace Omdb\Search;

use Omdb\Api\ApiInterface;
use Omdb\Api\Exception\OmdbException;

class SearchFactory
{
    private ApiInterface $api;

    public function __construct(ApiInterface $api)
    {
        $this->api = $api;
    }

    public function make($params): Searchable
    {
        if (empty($params)) {
            throw new \InvalidArgumentException("Provide not empty search");
        }
        if (!is_string($params) && !is_array($params)) {
            throw new \InvalidArgumentException("Provide string or array param");
        }
        if (is_string($params)) {
            $search = new Search($params, $this->api);
        }
        if (is_array($params) && isset($params['search'])) {
            $search = new Search($params['search'], $this->api);
        }
        if (is_array($params) && isset($params['title'])) {
            $search = new TitleSearch($params['title'], $this->api);
        }
        if (is_array($params) && isset($params['imdb'])) {
            $search = new ImdbIdSearch($params['imdb'], $this->api);
        }
        if (empty($search)) {
            throw new OmdbException("Can't instantiate search class");
        }
        return $search;
    }
}
