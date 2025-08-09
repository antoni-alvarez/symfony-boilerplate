<?php

declare(strict_types=1);

namespace App\Adapter\Framework\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestController extends AbstractController
{
    public function __construct(
    ) {}

    #[Route(path: '/test', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return $this->json(['message' => 'Symfony boilerplate up and running.'], Response::HTTP_OK);
    }
}
