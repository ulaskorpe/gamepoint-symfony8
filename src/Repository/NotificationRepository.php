<?php

namespace App\Repository;

use App\Document\Notification;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

/**
 * @extends DocumentRepository<Notification>
 */
class NotificationRepository extends DocumentRepository
{
    /** @return list<Notification> */
    public function findByUserId(int $userId, int $limit = 50): array
    {
        return $this->createQueryBuilder()
            ->field('user_id')->equals($userId)
            ->sort('created_at', 'desc')
            ->limit($limit)
            ->getQuery()
            ->execute()
            ->toArray();
    }

    public function countUnreadByUserId(int $userId): int
    {
        return $this->createQueryBuilder()
            ->field('user_id')->equals($userId)
            ->field('read')->equals(false)
            ->count()
            ->getQuery()
            ->execute();
    }
}
