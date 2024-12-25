<?php

declare(strict_types=1);

namespace Common\Infrastructure\MessageBus\Symfony;

use Symfony\Component\Messenger\MessageBusInterface;

class SymfonyMessageBus
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function dispatch(object $message): void
    {
        $this->bus->dispatch($message);
    }
}