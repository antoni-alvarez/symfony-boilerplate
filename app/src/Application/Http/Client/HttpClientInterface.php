<?php

declare(strict_types=1);

namespace App\Application\Http\Client;

use App\Application\Http\Response\HttpResponseInterface;

interface HttpClientInterface
{
    /**
     * @param array<string, mixed> $options
     */
    public function request(string $method, string $url, array $options = []): HttpResponseInterface;
}
