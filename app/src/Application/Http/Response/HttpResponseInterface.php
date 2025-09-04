<?php

declare(strict_types=1);

namespace App\Application\Http\Response;

interface HttpResponseInterface
{
    public function getStatusCode(): int;

    public function getContent(): string;

    /**
     * @return array<mixed, mixed>
     */
    public function toArray(): array;

    /**
     * @return array<string, mixed>
     */
    public function getHeaders(): array;
}
