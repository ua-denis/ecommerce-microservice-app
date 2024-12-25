<?php

declare(strict_types=1);

namespace Common\Domain\ValueObject;

use InvalidArgumentException;

class Currency
{
    private string $code;

    public function __construct(string $code)
    {
        if (!preg_match('/^[A-Z]{3}$/', $code)) {
            throw new InvalidArgumentException('Invalid currency code.');
        }

        $this->code = strtoupper($code);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function equals(Currency $other): bool
    {
        return $this->code === $other->code;
    }

    public function __toString(): string
    {
        return $this->code;
    }
}