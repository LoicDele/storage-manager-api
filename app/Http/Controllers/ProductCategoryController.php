<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return ProductCategory::all();
    }
    public function show($id)
    {
        $category = ProductCategory::find($id);
        $products = $category->products()->get();
        return response()->json([$category, $products], 200);
    }
}
