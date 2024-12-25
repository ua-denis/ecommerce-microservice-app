<?php

declare(strict_types=1);

namespace Common\Application\Bus\Message;

use Common\Application\Bus\Command\CommandInterface;
use Common\Application\Bus\Event\EventInterface;
use Common\Application\Bus\Query\QueryInterface;

interface MessageBusInterface
{
    public function dispatchCommand(CommandInterface $command): void;

    public function dispatchEvent(EventInterface $event): void;

    public function dispatchQuery(QueryInterface $query): void;
}