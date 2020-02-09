<?php

namespace App\Console\Commands;

use App\Card;
use Illuminate\Console\Command;
use Elasticsearch\Client;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';

    /**
     * @var \Elasticsearch\Client
     */
    private $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');

        foreach (Card::cursor() as $card) {
            $this->client->index([
                'index' => $card->getSearchIndex(),
                'type' => $card->getSearchType(),
                'id' => $card->getKey(),
                'body' => $card->toSearchArray(),
            ]);
            $this->output->write('.');
        }

        $this->info("\nDone!");
    }
}
