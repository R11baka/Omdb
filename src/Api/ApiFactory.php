<?php

namespace Omdb\Api;

use Omdb\Api\HttpClient\CurlClient;

class ApiFactory
{
    public function make(): Api
    {
        $client = new CurlClient();
        return new Api($client);
    }

}
