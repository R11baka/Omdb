<?php

declare(strict_types=1);

namespace Omdb\Api;

use Omdb\Api\HttpClient\CurlClient;

class ApiFactory
{
    public function make(): ApiInterface
    {
        $client = new CurlClient();
        return new Api($client);
    }
}
