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
    private int $take = 10;

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

    public function take(int $take)
    {
        if ($take <= 0) {
            throw new \InvalidArgumentException("take can't be negative");
        }
        $this->take = $take;
    }

    /**
     * @return SearchResult[]
     * @throws ApiException|OmdbException
     */
    public function search(): array
    {
        $result = [];
        $page = 1;
        do {
            $this->searchParams['page'] = $page;
            try {
                $response = $this->api->search($this->searchParams);
            } catch (ApiException $e) {
                break;
            }
            if (empty($response) || !isset($response['Search'])) {
                throw new ApiException("Incorrect search result");
            }
            foreach ($response['Search'] as $item) {
                $result[] = new SearchResult($item);
            }
            $page++;
        } while (count($result) < $this->take);
        if ($this->take < count($result)) {
            $result = array_slice($result, 0, $this->take);
        }

        return $result;
    }
}
