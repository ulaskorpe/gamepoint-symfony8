<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Event\TechnicalCreatedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: TechnicalCreatedEvent::class)]
final class TechnicalCreatedSysLogSubscriber
{
    public function __invoke(TechnicalCreatedEvent $event): void
    {
        $technical = $event->getTechnical();

        appSysLog(
            'technical.create',
            'Technical kayıt oluşturuldu',
            [
                'technical_id' => (string) $technical->getId(),
                'title' => $technical->getTitle() ?? '',
            ],
        );
    }
}
