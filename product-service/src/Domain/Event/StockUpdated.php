<?php

declare(strict_types=1);

namespace App\Domain\Event;

class StockUpdated
{
    private int $productId;
    private float $newQuantity;

    public function __construct(int $productId, float $newQuantity)
    {
        $this->productId = $productId;
        $this->newQuantity = $newQuantity;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getNewQuantity(): float
    {
        return $this->newQuantity;
    }
}