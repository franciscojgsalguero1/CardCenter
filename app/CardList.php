<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardList extends Model {
    use SoftDeletes;

    protected $fillable = [
        'name',
        'seller',
        'card_id',
        'language',
        'price',
        'quantity',
        'condition',
        'comment',
        'fullArt',
        'foil',
        'signed',
        'uber',
        'playset'
    ];
}
