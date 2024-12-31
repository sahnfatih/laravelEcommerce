@extends('frontend.shared.frontend_theme')
@section('title', 'Ödeme Başarılı')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="card-title mb-3">Ödeme Başarılı!</h4>
                    <p class="card-text">
                        Siparişiniz başarıyla alındı. Sipariş numaranız: <strong>#{{$order_id}}</strong>
                    </p>
                    <p class="text-muted">
                        Siparişinizle ilgili güncellemeler e-posta adresinize gönderilecektir.
                    </p>
                    <a href="/" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Anasayfaya Dön
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
