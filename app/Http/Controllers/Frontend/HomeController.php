<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::with(['category', 'images'])
                          ->where("is_active", true)
                          ->get();
        $categories = Category::where("is_active", true)->get();

        return view("frontend.home.index", [
            "categories" => $categories,
            "products" => $products
        ]);
    }
}
