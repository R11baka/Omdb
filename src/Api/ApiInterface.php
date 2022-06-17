<?php

declare(strict_types=1);

namespace Omdb\Api;

interface ApiInterface
{
    public function search($params);
}
