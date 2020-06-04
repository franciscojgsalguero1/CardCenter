<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model {
    use SoftDeletes;

    protected $fillable = [
        'seller',
        'card_name',
        'language',
        'condition',
        'card_seller_id',
        'buyer',
        'status',
        't_quantity',
        'price_unit',
        'total_price',
        'certified',
    	'date_paid',
        'date_received'
    ];
}