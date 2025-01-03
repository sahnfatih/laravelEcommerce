@extends('frontend.shared.frontend_theme')
@section('title', 'Ödeme Başarısız')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="mb-4">Ödeme İşlemi Başarısız!</h2>
                    <p class="lead mb-4">Sipariş numaranız: <strong>{{ $order->order_number }}</strong></p>
                    <p class="mb-4">Toplam tutar: <strong>{{ number_format($order->total, 2) }} TL</strong></p>
                    <hr class="my-4">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('payment.checkout', $order) }}" class="btn btn-primary">
                            <i class="fas fa-sync me-2"></i>Tekrar Dene
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i>Anasayfaya Dön
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
