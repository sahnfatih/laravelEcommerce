@extends('frontend.shared.frontend_theme')
@section('title', 'Siparişlerim')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-shopping-bag fs-2 text-primary me-3"></i>
                <h2 class="mb-0">Siparişlerim</h2>
            </div>

            @if($orders->isEmpty())
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-box-open text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-4 mb-3">Henüz Siparişiniz Bulunmuyor</h4>
                        <p class="text-muted mb-4">Alışveriş yaparak siparişlerinizi buradan takip edebilirsiniz.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-cart me-2"></i>Alışverişe Başla
                        </a>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3">Sipariş No</th>
                                    <th class="py-3">Tarih</th>
                                    <th class="py-3">Tutar</th>
                                    <th class="py-3">Durum</th>
                                    <th class="py-3 text-end pe-4">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="px-4 fw-bold">{{ $order->order_number }}</td>
                                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                        <td>{{ number_format($order->total, 2) }} TL</td>
                                        <td>{!! $order->status_badge !!}</td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('orders.show', $order) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i> Detay
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
