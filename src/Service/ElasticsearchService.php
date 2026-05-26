<?php

namespace App\Service;

use App\Entity\Game;
use App\Repository\GameRepository;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class ElasticsearchService
{
    public const INDEX_GAMES = 'gamepoint_games';

    private readonly Client $client;

    public function __construct(
        #[Autowire(env: 'ELASTICSEARCH_URL')]
        private readonly string $elasticsearchUrl,
    ) {
        $this->client = ClientBuilder::create()
            ->setHosts([$this->elasticsearchUrl])
            ->build();
    }

    public function client(): Client
    {
        return $this->client;
    }

    /** @return array<string, mixed> */
    public function getClusterInfo(): array
    {
        return $this->client->info()->asArray();
    }

    /** Oyun indeksini yoksa oluşturur. */
    public function ensureGamesIndex(): void
    {
        if ($this->indexExists(self::INDEX_GAMES)) {
            return;
        }

        $this->client->indices()->create([
            'index' => self::INDEX_GAMES,
            'body' => [
                'mappings' => [
                    'properties' => [
                        'title' => ['type' => 'text'],
                        'description' => ['type' => 'text'],
                        'category_id' => ['type' => 'integer'],
                        'category_title' => ['type' => 'keyword'],
                        'image' => ['type' => 'keyword'],
                    ],
                ],
            ],
        ]);
    }

    /** Tek oyunu Elasticsearch'e yazar. */
    public function indexGame(Game $game): void
    {
        $this->ensureGamesIndex();

        $category = $game->getCategory();

        $this->client->index([
            'index' => self::INDEX_GAMES,
            'id' => (string) $game->getId(),
            'body' => [
                'title' => $game->getTitle(),
                'description' => $game->getDescription(),
                'category_id' => $category?->getId(),
                'category_title' => $category?->getTitle(),
                'image' => $game->getImage(),
            ],
        ]);
    }

    /** Veritabanındaki tüm oyunları indeksler. */
    public function reindexAllGames(GameRepository $gameRepository): int
    {
        $games = $gameRepository->findAll();
        foreach ($games as $game) {
            $this->indexGame($game);
        }

        return count($games);
    }

    /**
     * Başlık ve açıklamada arama yapar.
     *
     * @return list<array<string, mixed>>
     */
    public function searchGames(string $query, int $limit = 20): array
    {
        $query = trim($query);
        if ('' === $query) {
            return [];
        }

        if (!$this->indexExists(self::INDEX_GAMES)) {
            return [];
        }

        $limit = max(1, min(100, $limit));

        /** @var Elasticsearch $response */
        $response = $this->client->search([
            'index' => self::INDEX_GAMES,
            'body' => [
                'size' => $limit,
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['title^3', 'description'],
                    ],
                ],
            ],
        ]);

        $hits = $response->asArray()['hits']['hits'] ?? [];

        return array_map(
            static fn (array $hit): array => [
                'id' => $hit['_id'] ?? null,
                'score' => $hit['_score'] ?? null,
                ...($hit['_source'] ?? []),
            ],
            $hits,
        );
    }

    private function indexExists(string $index): bool
    {
        try {
            return $this->client->indices()->exists(['index' => $index])->asBool();
        } catch (ClientResponseException|MissingParameterException|ServerResponseException) {
            return false;
        }
    }
}
