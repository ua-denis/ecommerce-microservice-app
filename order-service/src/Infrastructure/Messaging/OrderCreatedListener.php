<?php

declare(strict_types=1);

namespace App\Infrastructure\Messaging;

use App\Domain\Event\OrderCreated;
use Psr\Log\LoggerInterface;

class OrderCreatedListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(OrderCreated $event): void
    {
        $this->logger->info('Order created', [
            'orderId' => $event->getOrderId(),
            'createdAt' => $event->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }
}