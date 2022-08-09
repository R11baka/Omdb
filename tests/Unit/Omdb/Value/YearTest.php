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
     * @testdox Correct years set up $year
     * @return void
     */
    public function correctYears($year)
    {
        Year::fromString($year);
        $this->assertTrue(true);
    }

    /**
     * @test
     * @dataProvider getIncorrectYears
     * @param $year
     * @testdox Incorrect year as $year
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
        return [['aaa'], [""], [null], [new \StdClass()]];
    }
}
