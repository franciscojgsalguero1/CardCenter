<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class List extends Model {
    use SoftDeletes;

    protected $fillable = [
        'name',
        'seller',
        'language',
        'price',
        'quantity',
        'condition',
        'comment',
        'fullArt',
        'foil',
        'signed',
        'uber',
        'playset',
        'src'
    ];
}
