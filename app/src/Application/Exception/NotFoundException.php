<?php

declare(strict_types=1);

namespace App\Application\Exception;

use ReflectionClass;
use RuntimeException;

use function sprintf;

final class NotFoundException extends RuntimeException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    /**
     * @param class-string $entity
     */
    public static function fromEntityAndId(string $entity, string $id): self
    {
        $shortName = new ReflectionClass($entity)->getShortName();

        return new self(sprintf('%s with id %s not found', $shortName, $id));
    }
}
