<?php

declare(strict_types = 1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\HearthstoneApiService;
use App\Card;
use Illuminate\Support\Arr;

class SyncAllCards extends Command
{
    /**
     * @var string
     */
    protected $signature = 'syncAll:cards';

    /**
     * @var string
     */
    protected $description = 'Syncs All Cards from the API to the DB';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $test =  new HearthstoneApiService();
        $response = Arr::flatten($test->getAllCards(), 1);

        foreach($response as $cardApi) {
            Card::firstOrCreate([ 'dbfId' => $cardApi['dbfId']],
                [
                    'cardId' => $cardApi['cardId'],
                    'name' => $cardApi['name'],
                    'cardSet' => $cardApi['cardSet'],
                    'type' => $cardApi['type'] ?? '',
                    'rarity' => $cardApi['rarity'] ?? '',
                    'cost' => $cardApi['cost'] ?? null,
                    'attack' => $cardApi['attack'] ?? null,
                    'health' => $cardApi['health'] ?? null,
                    'text' => $cardApi['text'] ?? '',
                    'flavor' => $cardApi['flavor'] ?? '',
                    'artist' => $cardApi['artist'] ?? '',
                    'collectible' => $cardApi['collectible'] ?? false,
                    'playerClass' => $cardApi['playerClass'] ?? '',
                    'multiClassGroup' => $cardApi['multiClassGroup'] ?? '',
                    'img' => $cardApi['img'] ?? '',
                    'imgGold' => $cardApi['imgGold'] ?? '',
                    'locale' => $cardApi['locale'] ?? '',
                    'race' => $cardApi['race'] ?? '',
                ]);
        }
    }
}
