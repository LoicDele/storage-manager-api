<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class PaymentType extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $hidden = [];

    public static function getRules()
    {
        return [
            'name' => 'required|unique:payment_types',
        ];
    }

    public function transactions()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
