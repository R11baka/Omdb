<?php

declare(strict_types=1);

namespace Omdb\Api;

use Omdb\Api\Exception\ParamsException;

class ParamsConverter
{
    const MAPPING = [
        'title' => 't',
        'imdbid' => 'i',
        'search' => 's',
        'imdb' => 'i',
        'year' => 'y',
        'apikey' => 'apikey'
    ];

    /**
     * @param array $params
     * @return array
     * @throws ParamsException
     */
    public function convert(array $params): array
    {
        $result = [];
        foreach ($params as $k => $value) {
            if (isset(self::MAPPING[$k])) {
                $newKey = self::MAPPING[$k];
                $result[$newKey] = (string)$value;
            }
        }
        if (empty($result)) {
            throw new ParamsException("Can't convert params");
        }
        return $result;
    }
}
