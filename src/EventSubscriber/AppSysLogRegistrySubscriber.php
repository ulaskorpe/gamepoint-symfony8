<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Service\AppSysLogService;
use App\Support\AppSysLogRegistry;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * HTTP ve console ortamında AppSysLogRegistry'ye servisi bağlar.
 */
final class AppSysLogRegistrySubscriber
{
    public function __construct(
        private readonly AppSysLogService $appSysLogService,
    ) {
    }

    #[AsEventListener(event: KernelEvents::REQUEST, priority: 512)]
    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        AppSysLogRegistry::set($this->appSysLogService);
    }

    #[AsEventListener(event: ConsoleEvents::COMMAND, priority: 512)]
    public function onConsoleCommand(ConsoleCommandEvent $event): void
    {
        AppSysLogRegistry::set($this->appSysLogService);
    }
}
