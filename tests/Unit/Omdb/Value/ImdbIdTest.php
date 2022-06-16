<?php

namespace Omdb\Tests\Unit\Omdb\Value;

use InvalidArgumentException;
use Omdb\Value\ImdbId;
use PHPUnit\Framework\TestCase;

class ImdbIdTest extends TestCase
{

    /**
     * @dataProvider getCorrectImdbId
     * @test
     */
    public function correctId($id, $expected)
    {
        $id = ImdbId::fromString($id);
        $this->assertSame($id->getImdbId(), $expected);
    }

    /**
     * @dataProvider getIncorrectId
     * @test
     */
    public function incorrectId($id)
    {
        $this->expectException(InvalidArgumentException::class);
        ImdbId::fromString($id);
    }

    public function getCorrectImdbId(): array
    {
        return [
            ['tt3896198', 'tt3896198'],
            ['tt2015381', 'tt2015381']
        ];
    }

    public function getIncorrectId()
    {
        return [
            ['aaaa'],
            ['tt1'],
        ];
    }
}
