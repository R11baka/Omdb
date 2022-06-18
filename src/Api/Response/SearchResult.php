<?php

declare(strict_types=1);

namespace Omdb\Api\Response;

use Omdb\Api\Exception\OmdbException;

class SearchResult
{
    private string $title;
    private int $year;
    private string $imdbId;
    private string $type;
    private string $poster;

    public function __construct(array $data)
    {
        if (empty($data)) {
            throw new OmdbException('empty data');
        }
        $this->title = $data['Title'];
        $this->year = intval($data['Year']);
        $this->imdbId = $data['imdbID'];
        $this->type = $data['Type'];
        $this->poster = $data['Poster'];
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPoster(): string
    {
        return $this->poster;
    }
}
