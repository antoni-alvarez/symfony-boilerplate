<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\EventListener;

use App\Adapter\Framework\Http\Transformer\ApiExceptionTransformer;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::EXCEPTION, method: 'onKernelException')]
final readonly class ApiExceptionListener
{
    public function __construct(
        private ApiExceptionTransformer $jsonExceptionTransformer,
    ) {}

    public function onKernelException(ExceptionEvent $event): void
    {
        $this->jsonExceptionTransformer->transform($event);
    }
}
