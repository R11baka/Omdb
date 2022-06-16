<?php

namespace Omdb\Tests\Unit\Omdb\Value;

use InvalidArgumentException;
use Omdb\Value\Year;
use PHPUnit\Framework\TestCase;

class YearTest extends TestCase
{

    /**
     * @dataProvider  getCorrectYears
     * @test
     * @return void
     */
    public function correctYears($year)
    {
        \Omdb\Value\Year::fromString($year);
        $this->assertTrue(true);
    }

    /**
     * @test
     * @dataProvider getIncorrectYears
     * @param $year
     * @return void
     */
    public function incorrectYears($year)
    {
        $this->expectException(InvalidArgumentException::class);
        Year::fromString($year);
    }

    public function getCorrectYears(): array
    {
        return [[2000], ['2000'], ['1988'], [1988]];
    }

    public function getIncorrectYears(): array
    {
        return [['aaa'], [""], [null], [new \StdClass]];
    }
}
