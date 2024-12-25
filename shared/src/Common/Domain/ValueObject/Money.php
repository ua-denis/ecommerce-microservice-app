<?php

declare(strict_types=1);

namespace Common\Domain\ValueObject;

use InvalidArgumentException;

class Money
{
    private int $amount;
    private Currency $currency;

    public function __construct(int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function add(Money $other): Money
    {
        if (!$this->currency->equals($other->currency)) {
            throw new InvalidArgumentException('Currencies must match.');
        }

        return new Money($this->amount + $other->amount, $this->currency);
    }

    public function toString(): string
    {
        return sprintf('%d %s', $this->amount, (string)$this->currency);
    }
}