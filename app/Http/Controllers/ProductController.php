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
        $product = new Product($request->all());
        $product->save();
        return response()->json($product,200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, Product::getRules());
        $product = Product::find($id);
        if ($product == null)
        {
            return response()->json('The product doesn\'t exist.', 404);
        }
        else
        {
            $product->fill($request->all());
            $product->save();
            return response()->json($product);
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
