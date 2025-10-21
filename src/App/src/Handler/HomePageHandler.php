<?php

declare(strict_types=1);

namespace App\Handler;

use App\CmdBus\HelloCommand;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use PhpCmd\CmdBus\CmdBusInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private readonly CmdBusInterface $cmdBus,
        private readonly ?TemplateRendererInterface $template = null
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = new HelloCommand('World');
        $result  = $this->cmdBus->handle($command);
        $data = [
            'message' => $result,
        ];

        return new HtmlResponse($this->template->render('app::home-page', $data));
    }
}
