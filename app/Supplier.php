<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'phoneNumber', 'address', 'mail'
    ];

    protected $hidden = [];

    public static function getRules()
    {
        return [
            'name' => 'required',
            'phoneNumber' => 'required|max:15',
            'address' => 'required|max:100',
            'mail' => 'required|email|max:30',
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id');
    }
}
