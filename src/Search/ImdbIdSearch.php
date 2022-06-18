<?php

declare(strict_types=1);

namespace Omdb\Search;

use Omdb\Api\ApiInterface;
use Omdb\Api\Response\Movie;
use Omdb\Value\ImdbId;

class ImdbIdSearch extends BaseSearch
{
    private ImdbId $imdbId;

    public function __construct(string $imdbId, ApiInterface $api)
    {
        parent::__construct($api);
        $this->imdbId = ImdbId::fromString($imdbId);
    }


    public function search(): Movie
    {
        $params = ['imdbId' => $this->imdbId];
        $result = $this->api->search($params);
        return new Movie($result);
    }
}
