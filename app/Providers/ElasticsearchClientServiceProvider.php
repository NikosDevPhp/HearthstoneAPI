<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use App\Repositories\CardsRepository;
use App\Repositories\CardsEloquentRepository;
use App\Repositories\ElasticsearchRepository;

class ElasticsearchClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CardsRepository::class, function ($app) {
            if(!config('services.search.enabled')) {
                return new CardsEloquentRepository();
            }
            return new ElasticsearchRepository(
               $app->make(Client::class)
            );

        });

        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
