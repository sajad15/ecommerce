<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return response(['Show Data Success' => $products]);
    }

    public function show(Product $product)
    {
        $category = $product->category;
        return response(['data per Category' => $category]);
    }

    public function searchByCategory(Category $category)
    {
        $products = $category->products;
        return response(['data' => $products]);
    }

    public function searchByKey (Request $request)
    {
        $products = Product::where('nama_product', 'LIKE', "%$request->key%")
                        ->orwhere('desc_product', 'LIKE', "%$request->key%")->get();

        return response(['data' => $products]);
    }
}
