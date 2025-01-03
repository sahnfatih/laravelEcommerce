@extends('frontend.shared.frontend_theme')
@section('title', 'Ödeme Başarılı')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <div class="success-animation">
                            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                        </div>
                    </div>
                    <h2 class="mb-4 text-success">Ödemeniz Başarıyla Tamamlandı!</h2>
                    <div class="bg-light rounded-3 p-4 mb-4">
                        <p class="lead mb-2">Sipariş numaranız:</p>
                        <h4 class="text-primary mb-0">{{ $order->order_number }}</h4>
                    </div>
                    <p class="mb-4 fs-5">
                        Toplam ödenen tutar:
                        <strong class="text-success">{{ number_format($order->total, 2) }} TL</strong>
                    </p>
                    <hr class="my-4">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-box me-2"></i>Siparişimi Görüntüle
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-home me-2"></i>Anasayfaya Dön
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.success-animation {
    animation: scale-up 0.5s ease-in-out;
}

@keyframes scale-up {
    0% {
        transform: scale(0.5);
        opacity: 0;
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}
</style>
@endsection
