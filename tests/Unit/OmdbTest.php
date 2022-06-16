<?php

namespace Omdb\Tests\Unit;

use JsonException;
use Omdb\Api\Api;
use Omdb\Api\HttpClient\Client;
use Omdb\Omdb;
use PHPUnit\Framework\TestCase;

class OmdbTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function checkSimpleSearch()
    {
        $api = $this->apiFactory();
        $omdb = new Omdb('apiKey', $api);
        $result = $omdb->search("Title");
        $this->assertIsArray($result);
    }

    /**
     * @test
     * @return void
     */
    public function cantCreateWithoutApiKey()
    {
        $this->expectException(\InvalidArgumentException::class);
        $omdb = new Omdb('');
    }

    /**
     * @test
     * @return void
     */
    public function incorrectResponse()
    {
        $this->expectException(JsonException::class);
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->method('getRequest')->willReturn('{');
        $clientMock->expects($this->once())->method('getRequest');

        $omdb = new Omdb('apiKey', new Api($clientMock));
        $omdb->search("Test");
    }

    private function apiFactory()
    {
        $clientMock = $this->getMockBuilder(Client::class)->getMock();
        $clientMock->method('getRequest')->willReturn('{}');
        $clientMock->expects($this->once())->method('getRequest');

        return new Api($clientMock);
    }
}
