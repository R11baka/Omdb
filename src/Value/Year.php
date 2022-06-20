<?php

declare(strict_types=1);

namespace Omdb\Value;

class Year
{
    private int $year;

    /**
     * @param string|int $year
     */
    private function __construct($year)
    {
        if (empty($year)) {
            throw new \InvalidArgumentException("Empty string");
        }
        if (!is_numeric($year)) {
            throw new \InvalidArgumentException("Incorrect year");
        }
        $this->year = (int)$year;
    }

    /**
     * @param string|int $year
     * @return Year
     */
    public static function fromString($year): Year
    {
        return new static($year);
    }

    public function __toString(): string
    {
        return (string)$this->year;
    }

    public function getYear(): int
    {
        return $this->year;
    }
}
