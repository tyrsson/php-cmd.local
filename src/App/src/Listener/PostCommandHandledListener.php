<?php

declare(strict_types=1);

namespace App\Listener;

use Override;
use PhpCmd\CmdBus\Command\CommandResult;
use PhpCmd\CmdBus\Command\CommandStatus;
use Webware\Event\EventInterface;
use Webware\Event\ListenerInterface;

final class PostCommandHandledListener implements ListenerInterface
{
    #[Override]
    public function __invoke(EventInterface $event): void
    {
        // Handle the event
        $commandResult = $event->getTarget();
        // take some post action based on the command result
    }
}
