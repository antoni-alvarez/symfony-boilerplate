<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Client;

use App\Adapter\Framework\Http\Response\SymfonyHttpResponse;
use App\Application\Exception\HttpClientException;
use App\Application\Http\Client\HttpClientInterface;
use App\Application\Http\Response\HttpResponseInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface as SymfonyHttpClientInterface;
use Throwable;

final readonly class SymfonyHttpClient implements HttpClientInterface
{
    public function __construct(
        private SymfonyHttpClientInterface $symfonyHttpClient,
    ) {}

    /**
     * @param array<string, mixed> $options
     */
    public function request(string $method, string $url, array $options = []): HttpResponseInterface
    {
        try {
            $response = $this->symfonyHttpClient->request($method, $url, $options);

            return new SymfonyHttpResponse($response);
        } catch (Throwable $t) {
            throw HttpClientException::createFromException($t->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
