<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showCheckoutForm()
    {
        $cart = Cart::where('user_id', Auth::user()->user_id)
            ->where('is_active', true)
            ->first();

        if (!$cart || $cart->details->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Sepetiniz boş.');
        }

        $cartItems = $cart->details()->with('product')->get();
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('frontend.checkout.form', compact('cartItems', 'total'));
    }

    public function processCheckout(Request $request)
    {
        // Ödeme işlemleri burada yapılacak
        return redirect()->route('cart.index')
            ->with('success', 'Siparişiniz alındı.');
    }
}
