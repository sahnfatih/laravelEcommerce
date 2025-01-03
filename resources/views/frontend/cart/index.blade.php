@extends('frontend.shared.frontend_theme')
@section('title', 'Sepetim')
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-shopping-cart fs-3 text-primary me-3"></i>
                <h2 class="mb-0">Sepetim</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($cartItems->isEmpty())
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-basket fs-1 text-muted mb-3"></i>
                        <h4>Sepetiniz Boş</h4>
                        <p class="text-muted">Sepetinizde henüz ürün bulunmamaktadır.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart me-2"></i>Alışverişe Başla
                        </a>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Ürün</th>
                                    <th>Fiyat</th>
                                    <th>Adet</th>
                                    <th>Toplam</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product->images->count() > 0)
                                                    <img src="{{ asset('storage/products/' . $item->product->images[0]->image_url) }}"
                                                         alt="{{ $item->product->name }}"
                                                         class="me-3"
                                                         style="width: 64px; height: 64px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                    <small class="text-muted">{{ $item->product->category->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->product->price, 2) }} TL</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->product->price * $item->quantity, 2) }} TL</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                Toplam: {{ number_format($cartItems->sum(function($item) {
                                    return $item->product->price * $item->quantity;
                                }), 2) }} TL
                            </h4>
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-credit-card me-2"></i>Ödemeye Geç
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
