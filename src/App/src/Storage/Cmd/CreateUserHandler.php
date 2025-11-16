<?php

declare(strict_types=1);

namespace App\Storage\Cmd;

use App\Storage\Entity\User;
use App\Storage\Schema;
use PhpCmd\CmdBus\CommandInterface;
use PhpCmd\CmdBus\CommandHandlerInterface;
use PhpCmd\CmdBus\Command\CommandResult;
use PhpCmd\CmdBus\Command\CommandResultInterface;
use PhpCmd\CmdBus\Command\CommandStatus;
use PhpDb\Adapter\AdapterInterface;
use PhpDb\Adapter\Driver\StatementInterface;
use PhpDb\Sql\Sql;
use PhpDb\TableGateway\Feature\FeatureSet;
use PhpDb\TableGateway\TableGateway;
use Psr\EventDispatcher\EventDispatcherInterface;
use Webware\Feature\EventDispatcherFeature;

use function json_encode;

final readonly class CreateUserHandler implements CommandHandlerInterface
{
    public function __construct(
        private AdapterInterface $dbAdapter,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function handle(
        CommandInterface $command
    ): CommandResultInterface {
        if (! $command instanceof CreateUserCmd) {
            throw new \InvalidArgumentException('Invalid command');
        }

        try {
            $table = new TableGateway(
                Schema::User->value,
                $this->dbAdapter,
                [new EventDispatcherFeature($this->eventDispatcher)]
            );

            $effectedRows = $table->insert([
                'identity' => $command->getIdentity(),
                'roles'    => json_encode($command->getRoles()),
                'details'  => json_encode($command->getDetails()),
            ]);

        } catch (\Throwable $th) {
            //log error
            throw $th;
        }
        return new CommandResult(
            command: $command,
            status: CommandStatus::Success,
            result: new User(
                id: $table->getLastInsertValue(),
                identity: $command->getIdentity(),
                roles: $command->getRoles(),
                details: $command->getDetails()
            )
        );
    }
}