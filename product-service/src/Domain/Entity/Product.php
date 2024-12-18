<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\DoctrineProductRepository")
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="float")
     */
    private float $price;

    /**
     * @ORM\Column(type="integer")
     */
    private int $qty;

    /**
     * @ORM\Column(type="float")
     */
    private float $income = 0;

    public function __construct(string $name, float $price, int $qty)
    {
        $this->name = $name;
        $this->price = $price;
        $this->qty = $qty;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setStockQuantity(int $quantity): void
    {
        if ($quantity < 0) {
            throw new InvalidArgumentException('Stock quantity cannot be negative.');
        }

        $this->qty = $quantity;
    }

    public function getIncome(): float
    {
        return $this->income;
    }

    public function setIncome(float $income): void
    {
        $this->income = $income;
    }

    public function updateIncome(float $amount): void
    {
        $this->income += $amount;
    }
}