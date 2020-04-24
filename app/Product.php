<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Product extends Model
{
    protected $fillable = [
        'name', 'salePrice', 'purchasePrice', 'description', 'category_id', 'supplier_id'
    ];

    protected $hidden = [];

    public static function getRules()
    {
        return [
            'name' => 'required|unique:products',
            'salePrice' => 'required|numeric',
            'purchasePrice' => 'required|numeric',
            'description' => 'required',
        ];
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
