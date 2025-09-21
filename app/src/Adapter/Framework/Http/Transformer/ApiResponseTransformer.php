<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Transformer;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final readonly class ApiResponseTransformer
{
    public function __construct(
        private NormalizerInterface $normalizer,
    ) {}

    public function transform(object $data, int $status = JsonResponse::HTTP_OK): JsonResponse
    {
        $data = $this->normalizer->normalize($data, 'json');

        return new JsonResponse([
            'data'  => $data,
            'error' => null,
        ], $status);
    }
}
