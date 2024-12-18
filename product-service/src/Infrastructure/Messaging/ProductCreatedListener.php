<?php

declare(strict_types=1);

namespace App\Infrastructure\Messaging;


use App\Application\Service\IncomeService;
use App\Domain\Event\ProductCreated;
use Exception;


class ProductCreatedListener
{
    private IncomeService $incomeService;

    public function __construct(IncomeService $incomeService)
    {
        $this->incomeService = $incomeService;
    }

    /**
     * @throws Exception
     */
    public function __invoke(ProductCreated $message): void
    {
        $productId = $message->getProductId();
        $orderAmount = $message->getOrderAmount();

        $this->incomeService->updateIncomeOnProductCreation($productId, $orderAmount);
    }
}