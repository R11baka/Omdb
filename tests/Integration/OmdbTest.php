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
     * @testdox Try to search with year
     */
    public function searchWithTitleAndYear()
    {
        $omdb = new Omdb(self::$apiKey);
        $resp = $omdb->title("ani")->year(2012)->search();
        $this->assertIsObject($resp);
        $this->assertInstanceOf(Movie::class, $resp);
    }

    /**
     * @test
     * @testdox Try to search not exists movie
     */
    public function movieNotFound()
    {
        $this->expectException(ApiException::class);
        $omdb = new Omdb(self::$apiKey);
        $omdb->title("ani")->year(1998)->search();
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
        $this->assertCount(10, $response);
        $this->assertContainsOnlyInstancesOf(SearchResult::class, $response);
        $first = $response[0];
        $this->assertIsString($first->getTitle());
        $this->assertIsString($first->getImdbId());
        $this->assertIsString($first->getType());
    }

    /**
     * @test
     * @testdox Checking if we can limit search result
     */
    public function searchWithTake()
    {
        $take = 15;
        $o = new Omdb(self::$apiKey);
        $response = $o->search(['search' => 'test', 'take' => $take]);
        $this->assertNotEmpty($response);
        $this->assertContainsOnlyInstancesOf(SearchResult::class, $response);
        $this->assertCount($take, $response);
    }

    /**
     * @test
     * @testdox Search with take, but resp has only several items
     */
    public function searchTake()
    {
        $take = 15;
        $o = new Omdb(self::$apiKey);
        $response = $o->search(['search' => 'AniMatrix', 'take' => $take]);
        $this->assertNotEmpty($response);
        $this->assertLessThan($take, count($response));
        $this->assertContainsOnlyInstancesOf(SearchResult::class, $response);
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

    /**
     * @test
     */
    public function searchMovie()
    {
        $omdb = new Omdb(self::$apiKey);
        $response = $omdb->search(['search' => 'ani', 'take' => 110]);
        $this->assertNotEmpty($response);
    }
}
