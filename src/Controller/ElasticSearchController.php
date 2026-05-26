<?php

namespace App\Controller;

use App\Repository\GameRepository;
use App\Service\ElasticsearchService;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ElasticSearchController extends AbstractController
{
    

    #[Route('/test-es', name: 'app_elasticsearch_test')]
    public function test(ElasticsearchService $es): JsonResponse
    {
      
            $info = $es->getClusterInfo();

            return new JsonResponse([
                'ok' => true,
                'cluster' => $info['cluster_name'] ?? null,
                'version' => $info['version']['number'] ?? null,
                'tagline' => $info['tagline'] ?? null,
            ]);
     
    }



    #[Route('/es/init', name: 'es_init')]
    public function init(ElasticsearchService $es): JsonResponse
    {
        $client = $es->client();

        $params = [
            'index' => 'activity_logs',
            'body' => [
                'mappings' => [
                    'properties' => [
                        'id' => ['type' => 'keyword'],
                        'logName' => ['type' => 'keyword'],
                        'description' => ['type' => 'text'],
                        'event' => ['type' => 'keyword'],
                        'customerId' => ['type' => 'keyword'],
                        'createdAt' => ['type' => 'date']
                    ]
                ]
            ]
        ];

        $response = $client->indices()->create($params);

        return new JsonResponse($response->asArray());
    }

    #[Route('/es/test-index', name: 'es_test_index')]
    public function testIndex(ElasticsearchService $es): JsonResponse
    {
        $client = $es->client();

        $client->index([
            'index' => 'activity_logs',
            'id' => 1,
            'body' => [
                'logName' => 'test',
                'description' => 'user logged in',
                'event' => 'login',
                'customerId' => '123',
                'createdAt' => date('c')
            ]
        ]);

        return new JsonResponse(['ok' => true]);
    }
    #[Route('/es/search', name: 'es_search')]
    public function search(ElasticsearchService $es): JsonResponse
    {
        $client = $es->client();

        $result = $client->search([
            'index' => 'activity_logs',
            'body' => [
                'query' => [
                    'match' => [
                        'description' => 'user'
                    ]
                ]
            ]
        ]);

        return new JsonResponse($result->asArray());
    }
}
