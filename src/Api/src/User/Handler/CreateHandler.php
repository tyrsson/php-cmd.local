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
        $data   = $request->getQueryParams();
        $cmd    = new CreateUserCmd(
            $data['email']
        );
        $result = $this->cmdBus->handle($cmd);
        return match ($result->getStatus()) {
            CommandStatus::Success => new JsonResponse(
                [
                    'status' => CommandStatus::Success->name,
                    'data'   => ($result->getResult())->toArray(),
                ],
                201
            ),
            CommandStatus::Failure => new JsonResponse(
                [
                    'status'  => CommandStatus::Failure->name,
                    'message' => 'User creation failed',
                ],
                422
            ),
        };
    }
}
