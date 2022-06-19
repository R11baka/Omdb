<?php

namespace Omdb\Search;

use Omdb\Api\ApiInterface;
use Omdb\Api\Exception\ApiException;
use Omdb\Api\Exception\OmdbException;
use Omdb\Api\Response\SearchResult;
use Omdb\Value\Year;

class Search extends BaseSearch
{
    private array $searchParams = [];

    public function __construct(string $search, ApiInterface $api)
    {
        parent::__construct($api);
        $this->searchParams['search'] = $search;
    }

    public function year(string $year)
    {
        $year = Year::fromString($year);
        $this->searchParams['year'] = $year;
    }

    /**
     * @return SearchResult[]
     * @throws ApiException|OmdbException
     */
    public function search(): array
    {
        $result = [];
        $response = $this->api->search($this->searchParams);
        if (empty($response) || !isset($response['Search'])) {
            throw new ApiException("Incorrect search result");
        }
        foreach ($response['Search'] as $item) {
            $result[] = new SearchResult($item);
        }
        return $result;
    }
}
