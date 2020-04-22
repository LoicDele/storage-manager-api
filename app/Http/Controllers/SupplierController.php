<?php

namespace App\Http\Controllers;

use App\Supplier;
use http\Env\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class SupplierController extends BaseController
{
    //
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);
        $products = $supplier->products()->get();
        if($supplier == null)
        {
            return response()->json('the supplier doesn\'t exist', 404);
        }
        else
        {
            return response()->json([$supplier, $products]);
        }
    }

    public function create(Request $request)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function delete($id)
    {

    }
}
