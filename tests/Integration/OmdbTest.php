<?php

namespace Omdb\Tests\Integration;

use Omdb\Api\Exception\ApiException;
use Omdb\Omdb;
use PHPUnit\Framework\TestCase;

class OmdbTest extends TestCase
{
    /**
     * @test
     * @return void
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
        $o = new Omdb('5e84d0ea');
        $resp = $o->title($title)->search();
        $this->assertIsObject($resp);
        $this->assertSame($title, $resp->getTitle());
    }

}
