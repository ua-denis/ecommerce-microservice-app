<?php

declare(strict_types=1);

namespace Common\Infrastructure\MessageBus\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;
use RuntimeException;

class RabbitMQMessageFactory
{
    private const DELIVERY_MODE_PERSISTENT = 2;

    public function createMessage(mixed $message, string $type): AMQPMessage
    {
        $payload = $this->encodePayload($message, $type);

        return new AMQPMessage(
            $payload,
            [
                'content_type' => 'application/json',
                'delivery_mode' => self::DELIVERY_MODE_PERSISTENT,
            ]
        );
    }

    private function encodePayload(mixed $message, string $type): string
    {
        $payload = json_encode(['type' => $type, 'message' => $message]);

        if ($payload === false) {
            throw new RuntimeException('Failed to encode message payload to JSON.');
        }

        return $payload;
    }
}