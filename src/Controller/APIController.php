<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class APIController extends AbstractController
{
    // İstek header veya sorgu parametresinden api_token okur (test için query destekli)
    private function extractApiToken(Request $request): string
    {
        $fromHeader = $request->headers->get('api-token')
            ?? $request->headers->get('x-api-token')
            ?? $request->headers->get('api_token');

        $token = trim((string) ($fromHeader ?? $request->query->getString('api_token')));

        return $token;
    }

    /** Verilen token veritabanındaki user.api_token ile eşleşiyorsa kullanıcıyı döner */
    private function authenticateByApiToken(Request $request, UserRepository $userRepository): ?User
    {
        $token = $this->extractApiToken($request);
        if ('' === $token) {
            return null;
        }

        return $userRepository->findOneByApiToken($token);
    }

    #[Route('/api/games', name: 'api_games', methods: ['GET'])]
    public function games(Request $request, UserRepository $userRepository, 
    GameRepository $gameRepository) 
    {
 
        $user = $this->authenticateByApiToken($request, $userRepository);
        if (!$user instanceof User) {
            return $this->json(['error' => 'Geçersiz veya eksik api_token.'], Response::HTTP_UNAUTHORIZED);
        }

        $categoryId = null;
        if ($request->query->has('category') && '' !== $request->query->get('category')) {
            return  $request->query->get('category');
            $cid = (int) $request->query->get('category');
            if ($cid > 0) {
                $categoryId = $cid;
            }
        }

        $keyword = $request->query->get('keyword');
        $keyword = \is_string($keyword) ? $keyword : null;

        $page = max(1, (int) $request->query->get('page', 1));
        $perPage = max(1, min(100, (int) $request->query->get('per_page', 30)));

        $result = $gameRepository->findForApi($categoryId, $keyword, $page, $perPage);

        $data = array_map(fn (Game $g) => $this->serializeGame($g), $result['items']);

        return $this->json([
            'games' => $data,
            'total' => $result['total'],
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    #[Route('/api/categories', name: 'api_categories', methods: ['GET'])]
    public function categories(Request $request, UserRepository $userRepository, CategoryRepository $categoryRepository): JsonResponse
    {
        $user = $this->authenticateByApiToken($request, $userRepository);
        if (!$user instanceof User) {
            return $this->json(['error' => 'Geçersiz veya eksik api_token.'], Response::HTTP_UNAUTHORIZED);
        }

        $list = $categoryRepository->findBy([], ['title' => 'ASC']);
        $data = [];
        foreach ($list as $c) {
            $data[] = [
                'id' => $c->getId(),
                'title' => $c->getTitle(),
                'description' => $c->getDescription(),
            ];
        }

        return $this->json(['categories' => $data]);
    }

    /** @return array<string, mixed> */
    private function serializeGame(Game $g): array
    {
        $cat = $g->getCategory();

        return [
            'id' => $g->getId(),
            'title' => $g->getTitle(),
            'description' => $g->getDescription(),
            'image' => $g->getImage(),
            'category' => [
                'id' => $cat?->getId(),
                'title' => $cat?->getTitle(),
            ],
        ];
    }
}
