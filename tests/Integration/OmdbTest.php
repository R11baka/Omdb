<?php

namespace Omdb\Tests\Integration;

use Omdb\Api\Exception\ApiException;
use Omdb\Api\Response\Movie;
use Omdb\Api\Response\SearchResult;
use Omdb\Omdb;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Omdb\Omdb
 */
class OmdbTest extends TestCase
{
    private static $apiKey;

    public static function setUpBeforeClass(): void
    {
        self::$apiKey = getenv('OMDB_APIKEY');
    }

    /**
     * @test
     * @testdox Test search with incorrect key
     * @covers \Omdb\Omdb::title
     * @throws \JsonException
     */
    public function fetchWithIncorrectApiKey()
    {
        $this->expectException(ApiException::class);
        $o = new Omdb('11111');
        $o->title('Test')->search();
    }

    /**
     * @test
     * @return void
     * @throws \JsonException
     */
    public function fetchMovieWithCorrectApiKey()
    {
        $title = 'The Matrix';
        $o = new Omdb(self::$apiKey);
        $resp = $o->title($title)->search();
        $this->assertIsObject($resp);
        $this->assertInstanceOf(Movie::class, $resp);
        $this->assertSame($title, $resp->getTitle());
    }

    /**
     * @test
     */
    public function searchByImdb()
    {
        $imdbId = "tt3896198";
        $o = new Omdb(self::$apiKey);
        $resp = $o->imdb($imdbId)->search();
        $this->assertSame($imdbId, $resp->getImdbID());
    }

    /**
     * @test
     */
    public function simpleSearch()
    {
        $o = new Omdb(self::$apiKey);
        $response = $o->search("The Matrix");
        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
        $this->assertIsObject($response[0]);
        $this->assertInstanceOf(SearchResult::class, $response[0]);
        $first = $response[0];
        $this->assertIsString($first->getTitle());
        $this->assertIsString($first->getImdbId());
        $this->assertIsString($first->getType());
    }

    /**
     * @test
     */
    public function searchWithTitle()
    {
        $o = new Omdb(self::$apiKey);
        $response = $o->search(['title' => 'The Matrix']);
        $this->assertIsObject($response);
        $this->assertInstanceOf(Movie::class, $response);
        $this->assertIsString($response->getImdbID());
    }

    /**
     * @test
     */
    public function searchImdb()
    {
        $imdbId = 'tt3896198';
        $o = new Omdb(self::$apiKey);
        $response = $o->search(['imdb' => $imdbId]);
        $this->assertIsObject($response);
        $this->assertInstanceOf(Movie::class, $response);
        $this->assertIsString($response->getImdbID());
        $this->assertEquals($response->getImdbID(), $imdbId);
    }
}
