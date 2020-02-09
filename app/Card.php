<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use Searchable;
    //
    protected $guarded = [];

    protected $casts = [
        'mechanics' => 'json'
    ];
}
