<?php

namespace Omdb\Search;

use Omdb\Api\ApiInterface;
use Omdb\Api\Exception\ApiException;
use Omdb\Api\Exception\OmdbException;
use Omdb\Api\Response\SearchResult;

class Search extends BaseSearch
{
    private string $search;

    public function __construct(string $search, ApiInterface $api)
    {
        parent::__construct($api);
        $this->search = $search;
    }

    /**
     * @return SearchResult[]
     * @throws ApiException|OmdbException
     */
    public function search(): array
    {
        $result = [];
        $params = ['search' => $this->search];
        $response = $this->api->search($params);
        if (empty($response) || !isset($response['Search'])) {
            throw new ApiException("Incorrect search result");
        }
        foreach ($response['Search'] as $item) {
            $result[] = new SearchResult($item);
        }
        return $result;
    }
}
