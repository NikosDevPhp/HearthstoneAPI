<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CardsRepository
{
    public function search(string $query = ''): Collection;
}
