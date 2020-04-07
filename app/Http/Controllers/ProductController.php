<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Psr\Log\NullLogger;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
        //return 'products';
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product == null)
        {
           return response()->json();
        }
        return response()->json($product);
    }

    public function create(Request $request)
    {
        $product = new Product();
        $product->name= $request->name;
        $product->salePrice = $request->salePrice;
        $product->purchasePrice = $request->purchasePrice;
        $product->description = $request->description;
        $product->save();
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name= $request->name;
        $product->salePrice = $request->salePrice;
        $product->purchasePrice = $request->purchasePrice;
        $product->description = $request->description;
        $product->save();
        return response()->json($product);

    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('the product is deleted');
    }

}
