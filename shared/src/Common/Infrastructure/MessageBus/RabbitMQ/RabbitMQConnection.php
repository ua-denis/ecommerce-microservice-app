<?php

declare(strict_types=1);

namespace Common\Infrastructure\MessageBus\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQConnection
{
    public static function create(string $host, int $port, string $user, string $password): AMQPStreamConnection
    {
        return new AMQPStreamConnection($host, $port, $user, $password);
    }
}