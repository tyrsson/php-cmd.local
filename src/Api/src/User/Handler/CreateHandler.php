<?php

declare(strict_types=1);

namespace Api\User\Handler;

use App\Storage\Cmd\CreateUserCmd;
use PhpCmd\CmdBus\Command\CommandStatus;
use PhpCmd\CmdBus\CmdBusInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

final readonly class CreateHandler implements RequestHandlerInterface
{
    public function __construct(
        private CmdBusInterface $cmdBus,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $request->getQueryParams();
        $cmd  = new CreateUserCmd(
            $data['email']
        );
        $result = $this->cmdBus->handle($cmd);
        return new JsonResponse(
            [
                'status' => $result->getStatus() === CommandStatus::Success ? CommandStatus::Success->name : CommandStatus::Failure->name,
                'userId' => $result->getResult(),
            ]
        );
    }
}
