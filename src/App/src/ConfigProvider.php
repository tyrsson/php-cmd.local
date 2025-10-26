<?php

declare(strict_types=1);

namespace App;

use PhpCmd\Event\PostHandleEvent;
use PhpCmd\Event\PreHandleEvent;
use Webware\Event\ConfigKey;
use Webware\Event\ListenerPriority as Priority;

class ConfigProvider
{
    public const DB_PATH = __DIR__ . '/../../../data/storage/phpcmd_test.db';
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies'              => $this->getDependencies(),
            'templates'                 => $this->getTemplates(),
            ConfigKey::Listeners->value => $this->getListeners(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class                 => Handler\PingHandler::class,
                Listener\PreCommandHandledListener::class  => Listener\PreCommandHandledListener::class,
                Listener\PostCommandHandledListener::class => Listener\PostCommandHandledListener::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
            ],
        ];
    }

    public function getListeners(): array
    {
        return [
            [
                'listener' => Listener\PreCommandHandledListener::class,
                'event'    => PreHandleEvent::class,
                'priority' => Priority::High->value,
            ],
            [
                'listener' => Listener\PostCommandHandledListener::class,
                'event'    => PostHandleEvent::class,
                'priority' => Priority::Low->value,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
