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
    public function create(Request $request)
    {
        $this->validate($request, ProductCategory::getRules());
        $category = new ProductCategory($request->toArray());
        $category->save();
        return response()->json($category,200);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, ProductCategory::getRules());
        $category = ProductCategory::find($id);
        if($category == null)
        {
            return response()->json('The product category doesn\'t exist.', 404);
        }
        else
        {
            $category->fill($request->all());
            $category->save();
            return response()->json($category,200);
        }

    }
}
