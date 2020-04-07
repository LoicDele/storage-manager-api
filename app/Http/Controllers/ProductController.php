<?php

namespace App\Http\Controllers;

use App\Product;

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
        return response()->json($product);
    }

}
