<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'username',
        'name',
        'type',
        'surname',
        'phone_number',
        'email',
        'password',
        'question',
        'answer',
        'balance',
        'street',
        'street_num',
        'city',
        'post_code',
        'country',
        'iban',
        'bicswift',
        'bank_name',
        'active'
    ];

    protected $hidden = [
        'password', 'remember_token', 'iban'
    ];
}