<?php

namespace Omdb\Api\HttpClient;

interface Client
{
    public function getRequest(string $url): string;
}
