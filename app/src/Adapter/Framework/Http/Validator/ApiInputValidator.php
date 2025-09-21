<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Validator;

use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use function count;

final readonly class ApiInputValidator
{
    public function __construct(
        private ValidatorInterface $validator,
    ) {}

    public function validate(object $dto): void
    {
        $violations = $this->validator->validate($dto);

        if (count($violations) > 0) {
            throw new ValidationFailedException($dto, $violations);
        }
    }
}
