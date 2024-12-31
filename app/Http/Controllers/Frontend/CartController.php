<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('signin.form');
        }

        $cart = Cart::where('user_id', Auth::user()->user_id)
            ->where('is_active', true)
            ->first();

        $cartItems = $cart ? $cart->details()->with('product')->get() : collect();

        return view('frontend.cart.index', compact('cartItems'));
    }
    public function add(Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('signin.form');
        }

        // Aktif sepeti bul veya oluştur
        $cart = Cart::firstOrCreate(
            [
                'user_id' => Auth::user()->user_id,
                'is_active' => true
            ],
            [
                'code' => Str::random(8)
            ]
        );

        // Ürünü sepete ekle
        CartDetails::create([
            'cart_id' => $cart->cart_id,
            'product_id' => $product->product_id,
            'quantity' => 1
        ]);

        // Başarı mesajı ve seçeneklerle birlikte session'a yönlendir
        return redirect()->back()->with([
            'success' => 'Ürün sepete eklendi',
            'showCartOptions' => true // Seçenekleri göstermek için flag
        ]);
    }

    public function remove(CartDetails $cartDetails)
    {
        $cartDetails->delete();
        return redirect()->route('cart.index');
    }
}
