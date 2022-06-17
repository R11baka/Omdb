<?php

declare(strict_types=1);

namespace Omdb\Value;

class Search
{
    private string $search;

    private function __construct(string $search)
    {
        if (empty($search)) {
            throw new \InvalidArgumentException("Can't be empty");
        }
        $this->search = $search;
    }

    public static function fromString(string $search): Search
    {
        return new Search($search);
    }

    public function __toString()
    {
        return $this->search;
    }


    public function getSearch(): string
    {
        return $this->search;
    }

}
