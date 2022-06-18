<?php

namespace Omdb\Tests\Unit;

use JsonException;
use Omdb\Api\Api;
use Omdb\Api\Exception\ApiException;
use Omdb\Api\HttpClient\Client;
use Omdb\Omdb;
use PHPUnit\Framework\TestCase;

class OmdbTest extends TestCase
{
    /**
     * @test
     */
    public function checkSimpleSearch()
    {
        $this->expectException(ApiException::class);
        $api = $this->apiFactory();
        $omdb = new Omdb('apiKey', $api);
        $omdb->search("Title");
    }

    /**
     * @test
     */
    public function cantCreateWithoutApiKey()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Omdb('');
    }

    /**
     * @test
     */
    public function incorrectResponse()
    {
        $this->expectException(JsonException::class);
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->method('getRequest')->willReturn('{');
        $clientMock->expects($this->once())->method('getRequest');

        $omdb = new Omdb('apiKey', new Api($clientMock,'apiKey'));
        $omdb->search("Test");
    }

    /**
     * @test
     */
    public function checkSearchByImdb()
    {
        $apiKey = 'apiKey';
        $imdbId = "tt3896198";
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->method('getRequest')->with("https://www.omdbapi.com/?i=$imdbId&apikey=$apiKey")->willReturn(
            file_get_contents('tests/Unit/__mock__/tt3896198.json')
        );
        $clientMock->expects($this->once())->method('getRequest');

        $omdb = new Omdb($apiKey, new Api($clientMock, $apiKey));
        $result = $omdb->imdb($imdbId)->search();
        $this->assertIsObject($result);
        $this->assertSame($imdbId, $result->getImdbID());
    }

    private function apiFactory(): Api
    {
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->method('getRequest')->willReturn('{}');
        $clientMock->expects($this->once())->method('getRequest');

        return new Api($clientMock, 'ApiKey');
    }
}
