<?php

namespace App\Repositories;

use App\Card;
use Illuminate\Database\Eloquent\Collection;

class CardsEloquentRepository implements CardsRepository
{
    public function search(string $query = ''): Collection
    {
        return Card::query()
                ->where('name', 'like', "%{$query}%")
                ->orWhere('text', 'like', "%{$query}%")
                ->orWhere('cardSet', 'like', "%{$query}%")
                ->get();
    }
}
