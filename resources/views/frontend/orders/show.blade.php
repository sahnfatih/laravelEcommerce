@extends('frontend.shared.frontend_theme')
@section('title', 'Sipariş Detayı')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('orders.index') }}" class="link-primary text-decoration-none">
                            <i class="fas fa-shopping-bag me-1"></i>Siparişlerim
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sipariş #{{ $order->order_number }}</li>
                </ol>
            </nav>

            <!-- Ana Kart -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Sipariş #{{ $order->order_number }}</h4>
                        {!! $order->status_badge !!}
                    </div>
                </div>
                <div class="card-body">
                    <!-- Sipariş ve Teslimat Bilgileri -->
                    <div class="row g-4 mb-4">
                        <!-- Sipariş Bilgileri -->
                        <div class="col-md-6">
                            <div class="p-4 rounded-3 border h-100">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>Sipariş Bilgileri
                                </h5>
                                <div class="mb-2">
                                    <strong>Tarih:</strong> {{ $order->created_at->format('d.m.Y H:i') }}
                                </div>
                                <div class="mb-2">
                                    <strong>Ödeme Yöntemi:</strong> {{ $order->payment_method ?? 'Belirtilmemiş' }}
                                </div>
                                @if($order->paid_at)
                                    <div class="mb-0">
                                        <strong>Ödeme Tarihi:</strong> {{ $order->paid_at->format('d.m.Y H:i') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Teslimat Bilgileri -->
                        <div class="col-md-6">
                            <div class="p-4 rounded-3 border h-100">
                                <h5 class="border-bottom pb-2 mb-3">
                                    <i class="fas fa-map-marker-alt me-2 text-primary"></i>Teslimat Bilgileri
                                </h5>
                                <div class="mb-2"><strong>Adres:</strong> {{ $order->address }}</div>
                                <div class="mb-2"><strong>Şehir:</strong> {{ $order->city }}</div>
                                <div class="mb-0"><strong>Telefon:</strong> {{ $order->phone }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Sipariş Detayları Tablosu -->
                    <div class="card border">
                        <div class="card-header py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-box me-2 text-primary"></i>Sipariş Detayları
                            </h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="py-3">Ürün</th>
                                        <th class="py-3 text-end">Birim Fiyat</th>
                                        <th class="py-3 text-center">Adet</th>
                                        <th class="py-3 text-end">Toplam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->details as $detail)
                                        <tr>
                                            <td>{{ $detail->product_name }}</td>
                                            <td class="text-end">{{ number_format($detail->unit_price, 2) }} TL</td>
                                            <td class="text-center">{{ $detail->quantity }}</td>
                                            <td class="text-end">{{ number_format($detail->total, 2) }} TL</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="border-top-2">
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Ara Toplam:</strong></td>
                                        <td class="text-end">{{ number_format($order->subtotal, 2) }} TL</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>KDV (18%):</strong></td>
                                        <td class="text-end">{{ number_format($order->tax, 2) }} TL</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Kargo:</strong></td>
                                        <td class="text-end">{{ number_format($order->shipping, 2) }} TL</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Genel Toplam:</strong></td>
                                        <td class="text-end text-primary"><strong>{{ number_format($order->total, 2) }} TL</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Geri Dön Butonu -->
            <div class="text-center">
                <a href="{{ route('orders.index') }}" class="btn btn-primary px-4">
                    <i class="fas fa-arrow-left me-2"></i>Siparişlerime Dön
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Tema renkleri ve değişkenleri */
:root {
    --border-color: var(--bs-border-color);
    --card-bg: var(--bs-body-bg);
    --table-hover-bg: var(--bs-tertiary-bg);
}

/* Genel stil ayarları */
.card {
    background-color: var(--card-bg);
}

.card-header {
    background-color: var(--card-bg);
    border-bottom-color: var(--border-color);
}

.border {
    border-color: var(--border-color) !important;
}

.border-bottom {
    border-bottom-color: var(--border-color) !important;
}

.table > :not(caption) > * > * {
    background-color: transparent;
}

.table-hover tbody tr:hover {
    background-color: var(--table-hover-bg);
}

.border-top-2 {
    border-top: 2px solid var(--border-color);
}

/* Gölge efekti */
.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
}

/* Responsive ayarları */
@media (max-width: 768px) {
    .table-responsive {
        margin: 0 -1rem;
    }
}
</style>
@endsection
