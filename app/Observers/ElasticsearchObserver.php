<?php
declare(strict_types = 1);

namespace App\Observers;

use Elasticsearch\Client;
use App\Card;

class ElasticsearchObserver
{
    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function saved($model): array
    {
        $this->client->index([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
            'body' => $model->toSearchArray(),
        ]);
    }

    public function deleted($model): array
    {
        $this->client->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
        ]);
    }
}
