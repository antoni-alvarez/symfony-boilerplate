<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Client;

use App\Adapter\Framework\Http\Response\GuzzleHttpResponse;
use App\Application\Exception\HttpClientException;
use App\Application\Http\Client\HttpClientInterface;
use App\Application\Http\Response\HttpResponseInterface;
use GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class GuzzleHttpClient implements HttpClientInterface
{
    public function __construct(
        private GuzzleHttpClientInterface $guzzleHttpClient,
    ) {}

    /**
     * @param array<string, bool> $options
     */
    public function request(string $method, string $url = '', array $options = []): HttpResponseInterface
    {
        try {
            $response = $this->guzzleHttpClient->request($method, $url, $options);

            return new GuzzleHttpResponse($response);
        } catch (Throwable $t) {
            throw HttpClientException::createFromException($t->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
