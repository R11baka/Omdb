<?php

declare(strict_types=1);

namespace Omdb\Value;

class Title
{
    private string $title;

    private function __construct(string $title)
    {
        if (empty(trim($title))) {
            throw new \InvalidArgumentException("Empty title");
        }
        $this->title = $title;
    }

    public static function fromString(string $title): Title
    {
        return new Title($title);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
