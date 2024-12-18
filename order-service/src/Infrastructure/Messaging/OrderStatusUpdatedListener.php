<?php

declare(strict_types=1);

namespace App\Infrastructure\Messaging;

use App\Domain\Event\OrderStatusUpdated;
use Psr\Log\LoggerInterface;

class OrderStatusUpdatedListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onOrderStatusUpdated(OrderStatusUpdated $event): void
    {
        $this->logger->info('Order status updated', [
            'orderId' => $event->getOrderId(),
            'oldStatus' => $event->getOldStatus(),
            'newStatus' => $event->getNewStatus(),
            'updatedAt' => $event->getUpdatedAt()->format('Y-m-d H:i:s')
        ]);
    }
}