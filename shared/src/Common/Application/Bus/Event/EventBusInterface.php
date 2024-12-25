<?php

declare(strict_types=1);

namespace Common\Application\Bus\Event;

interface EventBusInterface
{
    public function publish(EventInterface $event): void;
}