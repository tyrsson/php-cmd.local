<?php

declare(strict_types=1);

namespace App\Listener;

use PhpCmd\CmdBus\Command\CommandResult;
use PhpCmd\CmdBus\Command\CommandStatus;
use Webware\Event\EventInterface;
use Webware\Event\ListenerInterface;

final class PreCommandHandledListener implements ListenerInterface
{
    public function __invoke(EventInterface $event): void
    {
        // Handle the event
        $command = $event->getTarget();
        $commandResult = new CommandResult(
            $command,
            CommandStatus::Success,
            "Pre-processing done for command: " . get_class($command)
        );
        $command->setResult($commandResult);
    }
}
