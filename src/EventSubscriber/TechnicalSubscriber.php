<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Entity\Technical;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Events;
use Gedmo\SoftDeleteable\Event\PostSoftDeleteEventArgs;
use Gedmo\SoftDeleteable\SoftDeleteableListener;
use Psr\Log\LoggerInterface;

/**
 * Doctrine ORM dinleyicisi: Technical için oluşturma, güncelleme ve (Gedmo) yumuşak silme.
 */
#[AsDoctrineListener(event: Events::postPersist)]
#[AsDoctrineListener(event: Events::postUpdate)]
#[AsDoctrineListener(event: SoftDeleteableListener::POST_SOFT_DELETE)]
final class TechnicalSubscriber
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function postPersist(PostPersistEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof Technical) {
            return;
        }

        $this->onTechnicalCreate($entity, $args);
    }

    public function postUpdate(PostUpdateEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof Technical) {
            return;
        }

        // Yumuşak silmede deletedAt güncellemesi de postUpdate tetikleyebilir; silme işi postSoftDelete'te işlenir
        if ($entity->isDeleted()) {
            return;
        }

        $this->onTechnicalUpdate($entity, $args);
    }

    public function postSoftDelete(PostSoftDeleteEventArgs $args): void
    {
        $entity = $args->getObject();
        if (!$entity instanceof Technical) {
            return;
        }

        $this->onTechnicalDelete($entity, $args);
    }

    // Yeni Technical kaydı persist sonrası
    private function onTechnicalCreate(Technical $technical, PostPersistEventArgs $args): void
    {
        $this->logger->info('technical.create', [
            'id' => $technical->getId(),
            'title' => $technical->getTitle(),
        ]);
    }

    // Technical güncelleme sonrası (silinmemiş kayıtlar)
    private function onTechnicalUpdate(Technical $technical, PostUpdateEventArgs $args): void
    {
        $this->logger->info('technical.update', [
            'id' => $technical->getId(),
            'title' => $technical->getTitle(),
        ]);
    }

    // Gedmo yumuşak silme tamamlandıktan sonra
    private function onTechnicalDelete(Technical $technical, PostSoftDeleteEventArgs $args): void
    {
        $this->logger->info('technical.soft_delete', [
            'id' => $technical->getId(),
            'title' => $technical->getTitle(),
        ]);
    }
}
