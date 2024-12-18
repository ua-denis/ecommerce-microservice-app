<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Order
{
    private string $id;
    private string $productId;
    private int $qty;
    private float $amount;

    public function __construct(string $productId, int $qty)
    {
        $this->id = uniqid('', true);
        $this->productId = $productId;
        $this->qty = $qty;

        $this->amount = 99.99 * $qty;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}