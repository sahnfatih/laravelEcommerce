<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Category $category): View
    {
        $products = Product::with(['category', 'images'])
                          ->where('category_id', $category->category_id)
                          ->where("is_active", true)
                          ->get();
        $categories = Category::where("is_active", true)->get();

        return view("frontend.home.index", [
            "categories" => $categories,
            "products" => $products,
            "selected_category" => $category
        ]);
    }
}
