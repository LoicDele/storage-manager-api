<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\PaymentType;

class PaymentTypeController extends Controller
{
    public function index()
    {
        $paymentTypes = PaymentType::all();
        return response()->json($paymentTypes, 200);
    }

    public function show($id)
    {
        $paymentType = PaymentType::find($id);
        if($paymentType == null)
        {
            return response()->json("The payment type doesn\'t exist", 404);
        }
        else
        {
            return response()->json($paymentType, 200);
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, PaymentType::getRules());
        if(PaymentType::where('name', '=', $request->name)->first() == null)
        {
            $paymentType = new PaymentType($request->all());
            $paymentType->save();
            return response()->json($paymentType, 200);
        }
        else
        {
            return response()->json("The name has already been taken.",422);
        }
    }

    public function update($id, Request $request)
    {
        $paymentType = PaymentType::find($id);
        if($paymentType == null)
        {
            return response()->json("The payment type doesn\'t exist", 404);
        }
        else
        {
            if(PaymentType::where('name', '=', $request->name) == null or $paymentType->name == $request->name)
            {
                $paymentType->fill($request->all());
                $paymentType->save();
                return response()->json($paymentType, 200);
            }
            else
            {
                return response()->json("The name has already been taken.",422);
            }
        }
    }

    public function delete($id)
    {
        $paymentType = PaymentType::find($id);
        if($paymentType == null)
        {
            return response()->json("The payment type doesn\'t exist", 404);
        }
        else
        {
            $paymentType->delete();
            return response()->json("the payment type is deleted", 200);
        }
    }
}
