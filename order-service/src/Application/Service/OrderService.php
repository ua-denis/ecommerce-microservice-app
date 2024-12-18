<?php

declare(strict_types=1);

namespace App\Application\Service;


use App\Application\Command\CreateOrderCommand;
use App\Domain\Entity\Order;
use App\Domain\Repository\OrderRepositoryInterface;
use App\Infrastructure\Messaging\OrderCreatedListener;
use Symfony\Component\Messenger\MessageBusInterface;

class OrderService
{
    private OrderRepositoryInterface $orderRepository;
    private MessageBusInterface $messageBus;

    public function __construct(OrderRepositoryInterface $orderRepository, MessageBusInterface $messageBus)
    {
        $this->orderRepository = $orderRepository;
        $this->messageBus = $messageBus;
    }

    public function createOrder(CreateOrderCommand $command): Order
    {
        $order = new Order($command->productId, $command->qty);
        $this->orderRepository->save($order);
        $this->messageBus->dispatch(new OrderCreatedListener($order));

        return $order;
    }
}