<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetails;
use App\Models\Product;
use Illuminate\Http\Request; // Bu satırı ekleyin/düzeltin
use Illuminate\Support\Facades\DB; // Bu satırı ekleyin
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\OrderDetails; // OrderDetails modelini import edin

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


    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();

            $cart = Cart::where('user_id', auth()->id())
                       ->where('is_active', true)
                       ->first();

            if (!$cart) {
                throw new \Exception('Sepet bulunamadı.');
            }

            $cartDetails = CartDetails::where('cart_id', $cart->cart_id)
                                    ->with('product')
                                    ->get();

            if ($cartDetails->isEmpty()) {
                throw new \Exception('Sepetiniz boş.');
            }

            // Sipariş oluştur
            $order = new Order();
            $order->user_id = auth()->id();
            $order->order_number = 'ORD-' . strtoupper(Str::random(10));
            $order->status = 'pending';

            // Hesaplamalar
            $subtotal = $cartDetails->sum(function($item) {
                return $item->product->price * $item->quantity;
            });

            $tax = $subtotal * 0.18;
            $shipping = 0;
            $total = $subtotal + $tax + $shipping;

            $order->subtotal = $subtotal;
            $order->tax = $tax;
            $order->shipping = $shipping;
            $order->total = $total;

            // Test için varsayılan adres
            $order->address = 'Test Adres';
            $order->city = 'Test Şehir';
            $order->phone = '5555555555';

            $order->save();

            // Sipariş detaylarını oluştur
            foreach ($cartDetails as $item) {
                OrderDetails::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->product->price,
                    'total' => $item->product->price * $item->quantity
                ]);
            }

            // Sepeti temizle
            $cartDetails->each->delete();
            $cart->delete();

            DB::commit();

            // Ödeme sayfasına yönlendir
            return redirect()->route('payment.checkout', $order);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Sipariş oluşturulurken bir hata oluştu: ' . $e->getMessage());
        }
    }
}
