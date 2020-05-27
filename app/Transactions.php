<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model {
    use SoftDeletes;

    protected $fillable = [
        'seller',
        'buyer',
        'card_name',
        'quantity',
        'price_unit',
        'status',
        'confirm',
        'certified',
        'tracking_code',
    	'date_paid',
        'date_sent',
        'date_received'
    ];
}
