<?php

declare(strict_types=1);

namespace Omdb\Value;

class ImdbId
{
    private string $imdbId;

    private function __construct(string $imdbId)
    {
        if (empty($imdbId)) {
            throw new \InvalidArgumentException("Empty string");
        }
        if (strlen($imdbId) < 5) {
            throw new \InvalidArgumentException("Id too short:" . $imdbId);
        }
        if (strpos($imdbId, 'tt') !== 0) {
            throw new \InvalidArgumentException("Incorrect imdbId:" . $imdbId);
        }
        $this->imdbId = $imdbId;
    }

    public static function fromString($omdb): ImdbId
    {
        return new static($omdb);
    }

    public function __toString()
    {
        return $this->imdbId;
    }

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

}
