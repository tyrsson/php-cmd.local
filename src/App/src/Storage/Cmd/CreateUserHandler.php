<?php

declare(strict_types=1);

namespace App\Storage\Cmd;

use App\Storage\Entity\User;
use App\Storage\Schema;
use PhpCmd\CmdBus\CommandInterface;
use PhpCmd\CmdBus\CommandHandlerInterface;
use PhpCmd\CmdBus\Command\CommandResult;
use PhpCmd\CmdBus\Command\CommandStatus;
use PhpDb\Adapter\AdapterInterface;
use PhpDb\TableGateway\TableGateway;

use function json_encode;

final readonly class CreateUserHandler implements CommandHandlerInterface
{
    public function __construct(
        private AdapterInterface $dbAdapter
    ) {
    }

    public function handle(
        CommandInterface $command
    ): mixed {
        if (! $command instanceof CreateUserCmd) {
            throw new \InvalidArgumentException('Invalid command');
        }

        $tableGateway = new TableGateway(
            adapter: $this->dbAdapter,
            table: Schema::User->value,
        );

        try {
            $result = $tableGateway->insert([
                'id'       => null,
                'identity' => $command->getIdentity(),
                'roles'    => json_encode($command->getRoles()),
                'details'  => json_encode($command->getDetails()),
            ]);
        } catch (\Throwable $th) {
            //log error
            throw $th;
        }

        return $result;
    }
}