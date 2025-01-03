<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function checkout(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Test için kredi kartı bilgileri
        $cardInfo = [
            'cardHolderName' => 'John Doe',
            'cardNumber' => '5528790000000008',
            'expireMonth' => '12',
            'expireYear' => '2030',
            'cvc' => '123'
        ];

        return view('frontend.payment.checkout', compact('order', 'cardInfo'));
    }

    public function process(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            // Ödeme simülasyonu
            $isSuccessful = rand(0, 100) > 10; // %90 başarı oranı

            if ($isSuccessful) {
                $order->update([
                    'status' => 'paid',
                    'payment_id' => 'TEST-' . Str::random(10),
                    'payment_method' => 'credit_card',
                    'paid_at' => now()
                ]);

                return redirect()->route('payment.success', $order)
                    ->with('success', 'Ödemeniz başarıyla alındı.');
            }

            $order->update(['status' => 'payment_failed']);
            return redirect()->route('payment.failed', $order)
                ->with('error', 'Ödeme işlemi başarısız oldu.');

        } catch (\Exception $e) {
            $order->update(['status' => 'payment_failed']);
            return redirect()->route('payment.failed', $order)
                ->with('error', 'Ödeme işlemi sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'paid') {
            return redirect()->route('orders.show', $order);
        }

        return view('frontend.payment.success', compact('order'));
    }

    public function failed(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('frontend.payment.failed', compact('order'));
    }
}
