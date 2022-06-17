<?php

declare(strict_types=1);

namespace Omdb\Api\Response;

class Movie
{
    private string $title;
    private int $year;
    private string $rated;
    private string $released;
    private ?int $runtime;
    private array $genre;
    private string $director;
    private array $actors;
    private string $plot;
    private string $language;
    private string $country;
    private string $poster;
    private string $awards;
    private array $ratings;
    private int $metascore;
    private float $imdbRating;
    private int $imdbVotes;
    private string $imdbID;
    private string $type;
    private string $dvd;
    private string $boxOffice;
    private ?string $production;
    private ?string $webSite;

    public function __construct(array $data)
    {
        if (empty($data)) {
            throw new \InvalidArgumentException("Empty data");
        }
        $this->title = $data['Title'];
        $this->year = intval($data['Year']);
        $this->rated = $data['Rater'] ?? '';
        $this->released = $data['Released'] ?? '';
        $this->runtime = intval($data['Runtime']) ?? null;
        $this->genre = explode(',', $data['Genre'] ?? '');
        $this->director = $data['Director'];
        $this->actors = explode(',', $data['Actors']);
        $this->plot = $data['Plot'] ?? '';
        $this->language = $data['Language'];
        $this->country = $data['Country'];
        $this->awards = $data['Awards'] ?? '';
        $this->poster = $data['Poster'] ?? '';
        $this->ratings = $data['Ratings'] ?? [];
        $this->metascore = intval($data['Metascore']);
        $this->imdbRating = floatval($data['imdbRating']);
        $this->imdbVotes = intval($data['imdbVotes']);
        $this->imdbID = $data['imdbID'];
        $this->type = $data['Type'];
        $this->dvd = $data['DVD'] ?? null;
        $this->boxOffice = $data['BoxOffice'];
        $this->production = $data['Production'] ?? null;
        $this->webSite = $data['Website'] ?? null;
    }

    /**
     * @return string[]
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @return string
     */
    public function getTitle()
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
    public function getRated()
    {
        return $this->rated;
    }

    /**
     * @return string
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @return int
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * @return string[]
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @return mixed|string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @return mixed|string
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * @return mixed|string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed|string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed|string
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @return mixed|string
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * @return array|mixed
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @return int
     */
    public function getMetascore(): int
    {
        return $this->metascore;
    }

    /**
     * @return float
     */
    public function getImdbRating(): float
    {
        return $this->imdbRating;
    }

    /**
     * @return int
     */
    public function getImdbVotes(): int
    {
        return $this->imdbVotes;
    }

    /**
     * @return mixed|string
     */
    public function getImdbID()
    {
        return $this->imdbID;
    }

    /**
     * @return mixed|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed|string|null
     */
    public function getDvd()
    {
        return $this->dvd;
    }

    /**
     * @return mixed|string
     */
    public function getBoxOffice()
    {
        return $this->boxOffice;
    }

    /**
     * @return mixed|string|null
     */
    public function getProduction()
    {
        return $this->production;
    }

    /**
     * @return mixed|string|null
     */
    public function getWebSite()
    {
        return $this->webSite;
    }

}
