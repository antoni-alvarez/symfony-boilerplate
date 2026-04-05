<?php

declare(strict_types=1);

namespace App\Application\Exception;

use RuntimeException;

final class BusinessLogicException extends RuntimeException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
