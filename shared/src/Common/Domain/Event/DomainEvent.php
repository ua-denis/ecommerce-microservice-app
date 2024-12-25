<?php

declare(strict_types=1);

namespace Common\Domain\Event;

use DateTimeImmutable;

interface DomainEvent
{
    public function occurredOn(): DateTimeImmutable;

    public function getPayload(): array;
}