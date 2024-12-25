<?php

declare(strict_types=1);

namespace Common\Application\Bus\Event;

use DateTimeImmutable;

interface EventInterface
{
    public function getEventId(): string;

    public function getEventName(): string;

    public function getOccurredAt(): DateTimeImmutable;
}