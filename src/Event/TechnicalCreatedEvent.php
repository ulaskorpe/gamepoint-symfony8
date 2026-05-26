<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Technical;
use Symfony\Contracts\EventDispatcher\Event;

final class TechnicalCreatedEvent extends Event
{
    public function __construct(
        private readonly Technical $technical,
    ) {
    }

    public function getTechnical(): Technical
    {
        return $this->technical;
    }
}
