<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        // Kategori filtresi
        $categorySlug = $request->route('category');
        $sortBy = $request->input('sort_by', 'default');

        // Temel ürün sorgusu
        $query = Product::with(['category', 'images'])
                       ->where('is_active', true);

        // Kategori filtresi uygula
        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('category_id', $category->category_id);
                $selectedCategory = $category;
            }
        }

        // Sıralama uygula
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'discount':
                $query->orderBy('discount_rate', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Ürünleri ve kategorileri getir
        $products = $query->get();
        $categories = Category::where('is_active', true)
                            ->whereNull('parent_id') // Sadece ana kategorileri getir
                            ->with('children') // Alt kategorileri de yükle
                            ->get();

        return view('frontend.home.index', [
            'categories' => $categories,
            'products' => $products,
            'selectedCategory' => $selectedCategory ?? null,
            'sortBy' => $sortBy
        ]);
    }
}
