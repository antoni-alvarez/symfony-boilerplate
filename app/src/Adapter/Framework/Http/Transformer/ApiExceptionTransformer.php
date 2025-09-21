<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Transformer;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Throwable;

use function implode;
use function in_array;
use function sprintf;

final readonly class ApiExceptionTransformer
{
    private const string UNEXPECTED_ERROR_MESSAGE = 'Unexpected error. Please try again.';

    public function transform(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();

        $status = $this->resolveStatus($e);
        $message = $this->resolveMessage($e);

        $payload = [
            'error' => [
                'code' => (string) $status,
                'message' => $message,
            ],
            'data' => null,
        ];

        $event->setResponse(new JsonResponse($payload, $status));
    }

    private function resolveStatus(Throwable $e): int
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($e instanceof HttpExceptionInterface) {
            return $e->getStatusCode();
        }

        if (in_array($e::class, $this->getBadRequestExceptions(), true)) {
            return Response::HTTP_BAD_REQUEST;
        }

        if (in_array($e::class, $this->getNotFoundExceptions(), true)) {
            return Response::HTTP_NOT_FOUND;
        }

        return $status;
    }

    private function resolveMessage(Throwable $e): string
    {
        if ($e instanceof ValidationFailedException) {
            $messages = [];

            foreach ($e->getViolations() as $violation) {
                $messages[] = sprintf(
                    '%s: %s',
                    $violation->getPropertyPath(),
                    $violation->getMessage(),
                );
            }

            return implode(', ', $messages);
        }

        if ($e instanceof HttpExceptionInterface
            || in_array($e::class, $this->getBadRequestExceptions(), true)
            || in_array($e::class, $this->getNotFoundExceptions(), true)) {
            return $e->getMessage();
        }

        return self::UNEXPECTED_ERROR_MESSAGE;
    }

    /**
     * @return array<int, class-string>
     */
    private function getBadRequestExceptions(): array
    {
        return [
            InvalidArgumentException::class,
            ValidationFailedException::class,
        ];
    }

    /**
     * @return array<int, class-string>
     */
    private function getNotFoundExceptions(): array
    {
        return [
            NotFoundHttpException::class,
        ];
    }
}
