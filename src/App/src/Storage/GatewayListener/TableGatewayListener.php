<?php

declare(strict_types=1);

namespace App\Storage\GatewayListener;

use Webware\Event\EventInterface;
use Webware\Event\ListenerInterface;

final class TableGatewayListener implements ListenerInterface
{
    public function __invoke(EventInterface $event): void
    {
        $target = $event->getName();
        $this->$target($event);
    }

    public function preInsert(EventInterface $event): void
    {
        $target = $event->getTarget();
        $params = $event->getParams();
    }

    public function postInsert(EventInterface $event): void
    {
        $target = $event->getTarget();
        $params = $event->getParams();
    }

    public function preUpdate(EventInterface $event): void
    {
        $target = $event->getTarget();
        $params = $event->getParams();
    }

    public function postUpdate(EventInterface $event): void
    {
        $target = $event->getTarget();
        $params = $event->getParams();
    }

    public function preDelete(EventInterface $event): void
    {
        $target = $event->getTarget();
        $params = $event->getParams();
    }

    public function postDelete(EventInterface $event): void
    {
        $target = $event->getTarget();
        $params = $event->getParams();
    }
}
