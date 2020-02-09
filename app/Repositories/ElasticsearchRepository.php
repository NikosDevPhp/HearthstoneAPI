<?php

namespace App\Repositories;

use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use App\Card;

class ElasticsearchRepository implements CardsRepository
{
    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * The search method that implements the CardsRepository interface
     * @param string $query
     * @return Collection
     */
    public function search(string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new Card;

        $items = $this->client->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['name^5', 'cardSet', 'text'],
                        'query' => $query,
                    ],
                ],
            ],
            'size' => 8000,
        ]);

        return $items;
    }

    private function buildCollection(array $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return Card::findMany($ids)
            ->sortBy(function ($card) use ($ids) {
                return array_search($card->getKey(), $ids);
            });
    }
}
