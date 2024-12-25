<?php

declare(strict_types=1);

namespace Common\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

class Uuid
{
    private UuidInterface $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = RamseyUuid::fromString($uuid);
    }

    public static function generate(): Uuid
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public static function isValid(string $uuid): bool
    {
        return RamseyUuid::isValid($uuid);
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }
}