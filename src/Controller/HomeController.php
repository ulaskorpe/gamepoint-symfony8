<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    private const GAMES_PER_PAGE = 30;

    public function __construct(
        private readonly GameRepository $gameRepository,
        private readonly CategoryRepository $categoryRepository,
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request): mixed
    {
        $categoryId = $this->resolveCategoryFilter($request->query->get('category'));


        $page = max(1, (int) $request->query->get('page', 1));

        $result = $this->gameRepository->findPaginated($categoryId, $page, self::GAMES_PER_PAGE);
        $total = $result['total'];
        $totalPages = max(1, (int) ceil($total / self::GAMES_PER_PAGE));
        if ($page > $totalPages) {
            $page = $totalPages;
            $result = $this->gameRepository->findPaginated($categoryId, $page, self::GAMES_PER_PAGE);
        }

        $queryParams = ['page' => $page];
        if (null !== $categoryId) {
            $queryParams['category'] = $categoryId;
        }

        return $this->render('home/index.html.twig', [
            'categories' => $this->categoryRepository->findBy([], ['title' => 'ASC']),
            'games' => $result['items'],
            'total' => $total,
            'page' => $page,
            'totalPages' => $totalPages,
            'currentCategoryId' => $categoryId,
            'queryParams' => $queryParams,
        ]);
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
