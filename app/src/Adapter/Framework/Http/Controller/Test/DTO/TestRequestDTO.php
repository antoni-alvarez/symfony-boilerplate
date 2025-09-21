<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Test\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class TestRequestDTO
{
    public function __construct(
        #[Assert\Length(min: 10, max: 50)]
        public ?string $message = 'Symfony boilerplate up and running.',
    ) {}
}
