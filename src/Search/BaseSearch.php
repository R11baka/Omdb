<?php

declare(strict_types=1);

namespace Omdb\Search;

use Omdb\Api\ApiInterface;

abstract class BaseSearch implements Searchable
{
    protected ApiInterface $api;

    public function __construct(ApiInterface $api)
    {
        $this->api = $api;
    }

    abstract public function search();
}
