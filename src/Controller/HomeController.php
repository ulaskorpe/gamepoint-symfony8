<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Game;
use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final class HomeController extends AbstractController
{
    private const GAMES_PER_PAGE = 30;
    private const CACHE_TTL = 300;

    private bool $use_cache = true;

    public function __construct(
        private readonly GameRepository $gameRepository,
        private readonly CategoryRepository $categoryRepository,
        private readonly CacheInterface $cache,
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request): mixed
    {
        $startedAt = hrtime(true);
        $cacheHit = false;

        $categoryId = $this->resolveCategoryFilter($request->query->get('category'));
        $page = max(1, (int) $request->query->get('page', 1));

        if ($this->use_cache) {
            $categoriesFromCache = false;
            $gamesFromCache = false;
            $categories = $this->getCachedCategories($categoriesFromCache);
            $result = $this->getCachedGames($categoryId, $page, $gamesFromCache);
            $cacheHit = $categoriesFromCache && $gamesFromCache;
        } else {
            $categories = $this->loadCategories();
            $result = $this->loadGames($categoryId, $page);
        }

        $total = $result['total'];
        $totalPages = max(1, (int) ceil($total / self::GAMES_PER_PAGE));
        if ($page > $totalPages) {
            $page = $totalPages;
            if ($this->use_cache) {
                $result = $this->getCachedGames($categoryId, $page, $gamesFromCache);
                $cacheHit = $cacheHit && $gamesFromCache;
            } else {
                $result = $this->loadGames($categoryId, $page);
            }
        }

        $queryParams = ['page' => $page];
        if (null !== $categoryId) {
            $queryParams['category'] = $categoryId;
        }

        $loadTimeMs = round((hrtime(true) - $startedAt) / 1_000_000, 2);

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'games' => $result['items'],
            'total' => $total,
            'page' => $page,
            'totalPages' => $totalPages,
            'currentCategoryId' => $categoryId,
            'queryParams' => $queryParams,
            'loadTimeMs' => $loadTimeMs,
            'cacheEnabled' => $this->use_cache,
            'cacheHit' => $cacheHit,
        ]);
    }

    /** @return list<array{id: int, title: string}> */
    private function loadCategories(): array
    {
        return array_map(
            static fn (Category $category): array => [
                'id' => (int) $category->getId(),
                'title' => (string) $category->getTitle(),
            ],
            $this->categoryRepository->findBy([], ['title' => 'ASC']),
        );
    }

    /** @return array{items: list<array{id: int, title: string, image: ?string}>, total: int} */
    private function loadGames(?int $categoryId, int $page): array
    {
        $result = $this->gameRepository->findPaginated($categoryId, $page, self::GAMES_PER_PAGE);

        return [
            'total' => $result['total'],
            'items' => array_map(
                static fn (Game $game): array => [
                    'id' => (int) $game->getId(),
                    'title' => (string) $game->getTitle(),
                    'image' => $game->getImage(),
                ],
                $result['items'],
            ),
        ];
    }

    /** @param-out bool $fromCache */
    private function getCachedCategories(bool &$fromCache): array
    {
        $fromCache = true;

        return $this->cache->get('home.categories', function (ItemInterface $item) use (&$fromCache): array {
            $fromCache = false;
            $item->expiresAfter(self::CACHE_TTL);

            return $this->loadCategories();
        });
    }

    /** @param-out bool $fromCache */
    private function getCachedGames(?int $categoryId, int $page, bool &$fromCache): array
    {
        $fromCache = true;
        $cacheKey = sprintf('home.games.%s.%d', $categoryId ?? 'all', $page);

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($categoryId, $page, &$fromCache): array {
            $fromCache = false;
            $item->expiresAfter(self::CACHE_TTL);

            return $this->loadGames($categoryId, $page);
        });
    }

    // Geçerli kategori id veya null (tümü)
    private function resolveCategoryFilter(mixed $raw): ?int
    {
        if (null === $raw || '' === $raw) {
            return null;
        }
        $id = (int) $raw;
        if ($id < 1) {
            return null;
        }
        if (null === $this->categoryRepository->find($id)) {
            return null;
        }

        return $id;
    }
}
