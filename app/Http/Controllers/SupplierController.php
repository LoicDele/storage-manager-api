<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class SupplierController extends Controller
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
        $this->validate($request, Supplier::getRules());
        if(Supplier::where('name', '=', $request->name)->first() == null)
        {
            $supplier = new Supplier($request->all());
            $supplier->save();
            return response()->json($supplier, 200);
        }
        else
        {
            return response()->json("The name has already been taken.",422);
        }

    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        if($supplier == null)
        {
            return response()->json('The supplier doesn\'t exist.', 404);
        }
        else
        {
            $this->validate($request, Supplier::getRules());
            if(Supplier::where('name', '=', $request->name)->first() == null or $supplier->name == $request->name)
            {
                $supplier->fill($request->all());
                $supplier->save();
                return response()->json($supplier, 200);
            }
            else
            {
                return response()->json("The name has already been taken.",422);
            }

        }
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);
        if($supplier == null)
        {
            return response()->json('The supplier doesn\'t exist.', 404);
        }
        else
        {
            $supplier->delete();
            return response('The product is deleted', 200);

        }
    }
}
