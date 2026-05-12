<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    // Kategori filtresi ve sayfalama ile oyunları ve toplam adedi döner.
    public function findPaginated(?int $categoryId, int $page, int $perPage): array
    {
        $page = max(1, $page);

        $qbCount = $this->createQueryBuilder('g')->select('COUNT(g.id)');
        if (null !== $categoryId) {
            $qbCount->andWhere('IDENTITY(g.category) = :cid')->setParameter('cid', $categoryId);
        }
        $total = (int) $qbCount->getQuery()->getSingleScalarResult();

        $qb = $this->createQueryBuilder('g')
            ->orderBy('g.id', 'DESC')
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage);
        if (null !== $categoryId) {
            $qb->andWhere('IDENTITY(g.category) = :cid')->setParameter('cid', $categoryId);
        }
        $items = $qb->getQuery()->getResult();

        return ['items' => $items, 'total' => $total];
    }

    /**
     * API: isteğe bağlı kategori id, başlıkta keyword (LIKE), sayfalama.
     *
     * @return array{items: list<Game>, total: int}
     */
    public function findForApi(?int $categoryId, ?string $keyword, int $page, int $perPage): array
    {
        $page = max(1, $page);
        $perPage = min(100, max(1, $perPage));

        $qbCount = $this->createQueryBuilder('g')->select('COUNT(g.id)');
        $this->applyApiGameFilters($qbCount, $categoryId, $keyword);
        $total = (int) $qbCount->getQuery()->getSingleScalarResult();

        $qb = $this->createQueryBuilder('g')
            ->orderBy('g.id', 'DESC')
            ->setFirstResult(($page - 1) * $perPage)
            ->setMaxResults($perPage);
        $this->applyApiGameFilters($qb, $categoryId, $keyword);
        $items = $qb->getQuery()->getResult();

        return ['items' => $items, 'total' => $total];
    }

    private function applyApiGameFilters(QueryBuilder $qb, ?int $categoryId, ?string $keyword): void
    {
        if (null !== $categoryId) {
            $qb->andWhere('IDENTITY(g.category) = :cid')->setParameter('cid', $categoryId);
        }
        if (null !== $keyword && '' !== trim($keyword)) {
            $raw = trim($keyword);
            $escaped = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $raw);
            $qb->andWhere('g.title LIKE :kw ESCAPE \'\\\\\'')->setParameter('kw', '%'.$escaped.'%');
        }
    }

//    /**
//     * @return Game[] Returns an array of Game objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Game
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
