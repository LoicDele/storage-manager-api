<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Transaction extends Model
{
    protected $fillable = [
        'product_id', 'price', 'number','paymentTypes_id',
    ];

    protected $hidden = [];

    public static function getRules()
    {
        return [
            'price' => 'required',
            'product_id' => 'required',
            'number' => 'required',
            'paymentTypes_id' => 'required',
        ];
    }

}
