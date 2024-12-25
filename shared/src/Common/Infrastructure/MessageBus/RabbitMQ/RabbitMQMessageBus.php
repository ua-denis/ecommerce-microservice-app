<?php

declare(strict_types=1);

namespace Common\Infrastructure\MessageBus\RabbitMQ;

use Common\Application\Bus\Command\CommandInterface;
use Common\Application\Bus\Event\EventInterface;
use Common\Application\Bus\Message\MessageBusInterface;
use Common\Application\Bus\Query\QueryInterface;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use RuntimeException;
use Throwable;

class RabbitMQMessageBus implements MessageBusInterface
{
    private AMQPStreamConnection $connection;
    private string $exchange;

    public function __construct(AMQPStreamConnection $connection, string $exchange)
    {
        $this->connection = $connection;
        $this->exchange = $exchange;
    }

    public function dispatchCommand(CommandInterface $command): void
    {
        $this->dispatch($command, 'command');
    }

    public function dispatchEvent(EventInterface $event): void
    {
        $this->dispatch($event, 'event');
    }

    public function dispatchQuery(QueryInterface $query): void
    {
        $this->dispatch($query, 'query');
    }

    private function dispatch(mixed $message, string $type): void
    {
        $channel = $this->createChannel();

        try {
            $this->declareExchange($channel);

            $messageFactory = new RabbitMQMessageFactory();
            $amqpMessage = $messageFactory->createMessage($message, $type);

            $channel->basic_publish($amqpMessage, $this->exchange);
        } catch (Throwable $exception) {
            throw new RuntimeException(
                sprintf('Failed to dispatch %s to RabbitMQ: %s', $type, $exception->getMessage()),
                0,
                $exception
            );
        }
        finally {
            $channel->close();
        }
    }

    private function createChannel(): AMQPChannel
    {
        return $this->connection->channel();
    }

    private function declareExchange(AMQPChannel $channel): void
    {
        $channel->exchange_declare($this->exchange, 'direct', false, true, false);
    }
}