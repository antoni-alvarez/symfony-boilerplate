<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Response;

use App\Application\Http\Response\HttpResponseInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

use function is_array;
use function json_decode;
use function json_last_error;
use function json_last_error_msg;

use const JSON_ERROR_NONE;

final readonly class GuzzleHttpResponse implements HttpResponseInterface
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
        return (string) $this->response->getBody();
    }

    /**
     * @return array<mixed, mixed>
     */
    public function toArray(): array
    {
        $body = (string) $this->response->getBody();

        $decoded = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Invalid JSON response: ' . json_last_error_msg());
        }

        if (!is_array($decoded)) {
            throw new RuntimeException('JSON did not decode to array');
        }

        return $decoded;
    }

    /**
     * @return array<array<string>>
     */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }
}
