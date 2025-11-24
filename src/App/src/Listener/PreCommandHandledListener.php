<?php

declare(strict_types=1);

namespace App\Listener;

use Override;
use Webware\Event\EventInterface;
use Webware\Event\ListenerInterface;

final class PreCommandHandledListener implements ListenerInterface
{
    #[Override]
    public function __invoke(EventInterface $event): void
    {
        // Handle the event
        $command = $event->getTarget();
        // take some pre action based on the command
    }
}
