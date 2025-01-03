@extends('frontend.shared.frontend_theme')
@section('title', 'Ödeme')
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4">Ödeme Bilgileri</h3>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Bu bir test ödemesidir. Gerçek ödeme alınmayacaktır.
                    </div>

                    <div class="mb-4">
                        <h5>Sipariş Özeti</h5>
                        <p class="mb-1">Sipariş No: {{ $order->order_number }}</p>
                        <p class="mb-1">Toplam Tutar: {{ number_format($order->total, 2) }} TL</p>
                    </div>

                    <form action="{{ route('payment.process', $order) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kart Sahibi</label>
                            <input type="text" class="form-control" value="{{ $cardInfo['cardHolderName'] }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kart Numarası</label>
                            <input type="text" class="form-control" value="{{ $cardInfo['cardNumber'] }}" readonly>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Son Kullanma Tarihi</label>
                                <input type="text" class="form-control"
                                       value="{{ $cardInfo['expireMonth'] }}/{{ $cardInfo['expireYear'] }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">CVC</label>
                                <input type="text" class="form-control" value="{{ $cardInfo['cvc'] }}" readonly>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-lock me-2"></i>
                            {{ number_format($order->total, 2) }} TL Öde
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
