<?php

declare(strict_types=1);

namespace App\Adapter\Infrastructure\Redis;

use Redis;
use RuntimeException;
use Symfony\Component\Cache\Adapter\RedisAdapter;

use function get_class;

class RedisClient
{
    private Redis $client;

    public function __construct(
        string $dsn,
        string $prefix,
    ) {
        $client = RedisAdapter::createConnection($dsn);

        if (!$client instanceof Redis) {
            throw new RuntimeException('[RedisClient] Expected Redis instance. Got: ' . get_class($client));
        }

        $this->client = $client;
        $this->client->setOption(Redis::OPT_PREFIX, $prefix);
    }

    public function getClient(): Redis
    {
        return $this->client;
    }
}
