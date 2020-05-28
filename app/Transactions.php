<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model {
    use SoftDeletes;

    protected $fillable = [
        'seller',
        'buyer',
        't_quantity',
        't_price',
        'status',
        'card_list',
        'certified',
    	'date_paid',
        'date_received'
    ];
}