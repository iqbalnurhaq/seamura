<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    public function detail(Request $request, $slug){
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('categories_id', $category->id)->paginate(32);

        return view('pages.category', [
            'category' => $category,
            'products' => $products
        ]);
    }
}
