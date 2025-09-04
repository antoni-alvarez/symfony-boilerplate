<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Response;

use App\Application\Http\Response\HttpResponseInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final readonly class SymfonyHttpResponse implements HttpResponseInterface
{
    public function __construct(
        private ResponseInterface $response,
    ) {}

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getContent(): string
    {
        return $this->response->getContent();
    }

    /**
     * @return array<mixed, mixed>
     */
    public function toArray(): array
    {
        return $this->response->toArray();
    }

    /**
     * @return array<array<string>>
     */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }
}
