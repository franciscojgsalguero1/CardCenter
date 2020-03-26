<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model {
    use SoftDeletes;

    protected $fillable = [
        'seller',
        'buyer',
        'quantity',
        't_price',
        'status',
        'certified',
        'tracking_code',
    	'date_paid',
        'date_sent',
        'date_received'
    ];
}
