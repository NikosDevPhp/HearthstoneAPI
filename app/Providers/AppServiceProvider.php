<?php

namespace App\Providers;

use App\Services\HearthstoneApiInterface;
use App\Services\HearthstoneApiService;
use App\Repositories\CardsEloquentRepository;
use App\Repositories\ElasticsearchRepository;
use App\Repositories\CardsRepository;
use Illuminate\Support\ServiceProvider;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HearthstoneApiInterface::class, HearthstoneApiService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
