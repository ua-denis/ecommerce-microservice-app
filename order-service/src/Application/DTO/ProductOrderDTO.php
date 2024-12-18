<?php

declare(strict_types=1);

namespace App\Application\DTO;

class ProductOrderDTO
{
    private string $productId;
    private string $productName;
    private float $productPrice;
    private int $quantity;
    private float $totalAmount;

    public function __construct(
        string $productId,
        string $productName,
        float $productPrice,
        int $quantity
    ) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->quantity = $quantity;
        $this->totalAmount = $productPrice * $quantity;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getProductPrice(): float
    {
        return $this->productPrice;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }
}