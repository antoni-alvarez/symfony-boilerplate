<?php

declare(strict_types=1);

namespace App\Application\Exception;

use RuntimeException;

class HttpClientException extends RuntimeException
{
    public static function createFromException(string $message, int $code = 0): self
    {
        return new self($message, $code);
    }
}
