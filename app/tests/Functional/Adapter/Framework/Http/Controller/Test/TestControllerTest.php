<?php

declare(strict_types=1);

namespace Tests\Functional\Adapter\Framework\Http\Controller\Test;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use function json_decode;
use function sprintf;
use function str_repeat;
use function urlencode;

use const JSON_THROW_ON_ERROR;

final class TestControllerTest extends WebTestCase
{
    private const string TEST_ENDPOINT_URL = '/test';

    private readonly KernelBrowser $client;

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->client = self::createClient();
    }

    #[Test]
    #[DataProvider('successDataProvider')]
    public function testSuccess(?string $message): void
    {
        $uri = self::TEST_ENDPOINT_URL;

        if ($message !== null) {
            $uri = sprintf('%s?message=%s', $uri, urlencode($message));
        }

        $this->client->request(Request::METHOD_GET, $uri);
        $response = $this->client->getResponse();

        self::assertResponseIsSuccessful('Expected 200 OK');

        $payload = json_decode((string) $response->getContent(), true, flags: JSON_THROW_ON_ERROR);

        self::assertArrayHasKey('error', $payload);
        self::assertArrayHasKey('data', $payload);

        self::assertNull($payload['error'], 'Error must be null on success');
        self::assertIsArray($payload['data'], 'Data must be an array');

        self::assertArrayHasKey('message', $payload['data']);
        self::assertSame($message, $payload['data']['message']);
    }

    public static function successDataProvider(): iterable
    {
        yield 'no message' => [null];
        yield 'valid short' => ['0123456789'];
        yield 'valid mid' => ['Hello valid message'];
        yield 'valid long' => ['xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'];
    }

    #[Test]
    #[DataProvider('invalidQueryProvider')]
    public function testValidationErrors(?string $message): void
    {
        $uri = self::TEST_ENDPOINT_URL;

        if ($message !== null) {
            $uri = sprintf('%s?message=%s', $uri, urlencode($message));
        }

        $this->client->request(Request::METHOD_GET, $uri);
        $response = $this->client->getResponse();

        self::assertResponseStatusCodeSame(Response::HTTP_BAD_REQUEST, 'Expected 400 Bad Request');

        $payload = json_decode((string) $response->getContent(), true, flags: JSON_THROW_ON_ERROR);

        self::assertArrayHasKey('error', $payload);
        self::assertArrayHasKey('data', $payload);

        self::assertIsArray($payload['error']);
        self::assertNull($payload['data'], 'Data must be null on error');

        self::assertArrayHasKey('code', $payload['error']);
        self::assertArrayHasKey('message', $payload['error']);

        self::assertNotSame('', (string) $payload['error']['message'], 'Error message must not be empty');
        self::assertSame('400', (string) $payload['error']['code'], 'Error code should be 400');
    }

    public static function invalidQueryProvider(): iterable
    {
        yield 'empty string' => [''];
        yield 'too short' => ['short'];
        yield 'too long' => [str_repeat('x', 51)];
    }
}
