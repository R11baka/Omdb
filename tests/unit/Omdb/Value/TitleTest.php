<?php

namespace Omdb\Tests\unit\Omdb\Value;

use InvalidArgumentException;
use Omdb\Omdb\Value\Title;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{

    /**
     * @test
     * @return void
     */
    public function correctTitle()
    {
        $t = Title::fromString('1111');
        $this->assertSame('1111', $t->getTitle());
    }

    /**
     * @test
     */
    public function checkIncorrectTitle()
    {
        $this->expectException(InvalidArgumentException::class);
        Title::fromString('  ');
    }

}
