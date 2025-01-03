@extends('frontend.shared.frontend_theme')
@section('title', 'Sepetim')
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <div class="cart-icon-wrapper me-3">
                    <i class="fas fa-shopping-cart fs-3" style="color: var(--hawk-accent);"></i>
                </div>
                <h2 class="mb-0" style="color: var(--hawk-text);">Sepetim</h2>
            </div>

            @if($cartItems->isEmpty())
                <div class="card" style="background: var(--hawk-card-bg); border-color: var(--hawk-border);">
                    <div class="card-body text-center py-5">
                        <div class="empty-cart-icon mb-3">
                            <i class="fas fa-shopping-basket fs-1" style="color: var(--hawk-accent);"></i>
                        </div>
                        <h4 style="color: var(--hawk-text);">Sepetiniz Boş</h4>
                        <p style="color: var(--hawk-text-secondary);">Sepetinizde henüz ürün bulunmamaktadır.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart me-2"></i>Alışverişe Başla
                        </a>
                    </div>
                </div>
            @else
                <div class="card" style="background: var(--hawk-card-bg); border-color: var(--hawk-border);">
                    <div class="table-responsive">
                        <table class="table align-middle" style="color: var(--hawk-text);">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50%;">Ürün</th>
                                    <th scope="col" class="text-center">Fiyat</th>
                                    <th scope="col" class="text-center">Adet</th>
                                    <th scope="col" class="text-center">Toplam</th>
                                    <th scope="col" class="text-end">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="product-image me-3">
                                                    @if($item->product->images->count() > 0)
                                                        <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                                                             alt="{{ $item->product->name }}"
                                                             style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                                    @else
                                                        <div class="no-image-placeholder"
                                                             style="width: 80px; height: 80px; background: var(--hawk-hover); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                            <i class="fas fa-image" style="color: var(--hawk-accent);"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="mb-1" style="color: var(--hawk-text);">{{ $item->product->name }}</h6>
                                                    <span class="badge" style="background: var(--hawk-accent);">
                                                        {{ $item->product->category->name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center price-tag">{{ number_format($item->product->price, 2) }} TL</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-center price-tag">{{ number_format($item->product->price * $item->quantity, 2) }} TL</td>
                                        <td class="text-end">
                                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        style="background: linear-gradient(145deg, #ff4b4b, #ff0000); border: none;">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer" style="background: var(--hawk-card-bg); border-color: var(--hawk-border);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="total-amount">
                                <h4 class="mb-0" style="color: var(--hawk-text);">
                                    Toplam:
                                    <span class="price-tag">
                                        {{ number_format($cartItems->sum(function($item) {
                                            return $item->product->price * $item->quantity;
                                        }), 2) }} TL
                                    </span>
                                </h4>
                            </div>
                            <div class="checkout-button">
                                <form action="{{ route('cart.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-credit-card me-2"></i>Ödemeye Geç
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.price-tag {
    color: var(--hawk-accent);
    font-weight: 600;
}

.cart-icon-wrapper {
    background: var(--hawk-hover);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.empty-cart-icon {
    background: var(--hawk-hover);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.product-info {
    max-width: 300px;
}

.table > :not(caption) > * > * {
    background: none;
    color: var(--hawk-text);
}

.btn-primary {
    background: linear-gradient(145deg, var(--hawk-secondary), var(--hawk-accent));
    border: none;
    padding: 0.8rem 1.5rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(98, 0, 234, 0.2);
}
</style>
@endsection
