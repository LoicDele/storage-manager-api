<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product == null)
        {
           return response()->json('The product doesn\'t exist.',404);
        }
        return response()->json($product, 200);
    }

    public function create(Request $request)
    {
        $this->validate($request, Product::getRules());
        if(Product::all()->where('name', '=', $request->name)->first() == null)
        {
            $product = new Product($request->all());
            $product->save();
            return response()->json($product,200);
        }
        else
        {
            return response()->json("The name has already been taken.",422);
        }

    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product == null)
        {
            return response()->json('The product doesn\'t exist.', 404);
        }
        else
        {
            $this->validate($request, Product::getRules());
            if(Product::where('name', '=', $request->name)->first() == null or $product->name == $request->name)
            {
                $product->fill($request->all());
                $product->save();
                return response()->json($product);
            }
            else
            {
                return response()->json("The name has already been taken.",422);
            }

        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product == null)
        {
            return response()->json('The product doesn\'t exist.', 404);
        }
        else {
            $product->delete();
            return response()->json('the product is deleted', 200);
        }
    }

}
