<?php

namespace App;

use App\Http\Controllers\PaymentTypeController;
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
            'product_id' => 'required|exists:products,id',
            'number' => 'required',
            'paymentType_id' => 'required|exists:payment_types,id',
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentTypeController::class, 'paymentType_id');
    }

}
