<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller\Test;

use App\Adapter\Framework\Http\Controller\Test\DTO\TestRequestDTO;
use App\Adapter\Framework\Http\Controller\Test\DTO\TestResponseDTO;
use App\Adapter\Framework\Http\Transformer\ApiResponseTransformer;
use App\Adapter\Framework\Http\Validator\ApiInputValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final class TestController extends AbstractController
{
    public function __construct(
        private ApiInputValidator $validator,
        private ApiResponseTransformer $responseTransformer,
    ) {}

    #[Route(path: '/test', methods: ['GET'])]
    public function __invoke(
        #[MapQueryParameter('message')]
        ?string $message,
    ): JsonResponse {
        $inputDto = new TestRequestDTO($message);
        $this->validator->validate($inputDto);

        return $this->responseTransformer->transform(new TestResponseDTO($inputDto->message));
    }
}
