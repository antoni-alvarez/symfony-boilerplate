<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Test\DTO;

final readonly class TestResponseDTO
{
    public function __construct(
        public ?string $message,
    ) {}
}
