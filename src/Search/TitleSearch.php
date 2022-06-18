<?php

declare(strict_types=1);

namespace Omdb\Search;

use Omdb\Api\ApiInterface;
use Omdb\Api\Response\Movie;
use Omdb\Value\Title;
use Omdb\Value\Year;

class TitleSearch extends BaseSearch
{
    private Title $title;

    private ?Year $year = null;

    public function __construct(string $title, ApiInterface $api)
    {
        parent::__construct($api);
        $this->title = Title::fromString($title);
    }

    public function year($year): void
    {
        $this->year = Year::fromString($year);
    }


    public function search(): Movie
    {
        $result = $this->api->search(['title' => $this->title, 'year' => $this->year]);
        return new Movie($result);
    }
}
