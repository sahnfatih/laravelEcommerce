@extends('frontend.shared.frontend_theme')
@section('title', 'Sepetim')
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-shopping-cart fs-3 text-accent me-3"></i>
                <h2 class="mb-0">Sepetim</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($cartItems->count() > 0)
                <div class="cart-wrapper">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" style="min-width: 300px;">Ürün</th>
                                    <th scope="col" style="min-width: 120px;">Fiyat</th>
                                    <th scope="col" style="min-width: 100px;">Adet</th>
                                    <th scope="col" style="min-width: 120px;">Toplam</th>
                                    <th scope="col" style="min-width: 80px;">İşlem</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product->images->count() > 0)
                                                    <div class="product-img-wrapper me-3">
                                                        <img src="{{ asset('storage/products/' . $item->product->images[0]->image_url) }}"
                                                             alt="{{ $item->product->name }}"
                                                             class="product-img">
                                                    </div>
                                                @endif
                                                <div class="product-info">
                                                    <h6 class="product-title mb-1">{{ $item->product->name }}</h6>
                                                    <span class="product-category">{{ $item->product->category->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="price">{{ number_format($item->product->price, 2) }} TL</td>
                                        <td>
                                            <div class="quantity-badge">
                                                {{ $item->quantity }}
                                            </div>
                                        </td>
                                        <td class="total">{{ number_format($item->product->price * $item->quantity, 2) }} TL</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-remove" title="Ürünü Sil">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $total += $item->product->price * $item->quantity; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-footer">
                        <div class="cart-summary">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="summary-text">Toplam:</span>
                                <span class="summary-total">{{ number_format($total, 2) }} TL</span>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <a href="{{ route('checkout.form') }}" class="btn-checkout">
                                <i class="fas fa-credit-card me-2"></i>Ödemeye Geç
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-basket empty-cart-icon mb-4"></i>
                        <h4>Sepetiniz Boş</h4>
                        <p class="text-muted">Sepetinizde henüz ürün bulunmamaktadır.</p>
                        <a href="{{ route('home') }}" class="btn-shopping">
                            <i class="fas fa-arrow-left me-2"></i>Alışverişe Devam Et
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Cart Wrapper */
.cart-wrapper {
    background: var(--hawk-card-bg);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

/* Table Styles */
.table {
    margin-bottom: 0;
}

.table thead th {
    background: var(--hawk-bg-secondary);
    color: var(--hawk-text);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    padding: 1rem;
    border-bottom: 2px solid var(--hawk-border);
}

.table tbody td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid var(--hawk-border);
}

/* Product Image */
.product-img-wrapper {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
}

.product-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-img:hover {
    transform: scale(1.05);
}

/* Product Info */
.product-title {
    color: var(--hawk-text);
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.product-category {
    color: var(--hawk-text-muted);
    font-size: 0.875rem;
}

/* Price and Total */
.price, .total {
    font-weight: 600;
    color: var(--hawk-text);
}

/* Quantity Badge */
.quantity-badge {
    background: var(--hawk-bg-secondary);
    color: var(--hawk-text);
    padding: 0.5rem 1rem;
    border-radius: 6px;
    display: inline-block;
    font-weight: 500;
}

/* Remove Button */
.btn-remove {
    background: var(--hawk-danger-soft);
    color: var(--hawk-danger);
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-remove:hover {
    background: var(--hawk-danger);
    color: white;
    transform: scale(1.05);
}

/* Cart Footer */
.cart-footer {
    margin-top: 2rem;
    border-top: 1px solid var(--hawk-border);
    padding-top: 2rem;
}

.cart-summary {
    background: var(--hawk-bg-secondary);
    padding: 1.5rem;
    border-radius: 8px;
}

.summary-text {
    font-size: 1.1rem;
    font-weight: 500;
    color: var(--hawk-text);
}

.summary-total {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--hawk-accent);
}

/* Checkout Button */
.btn-checkout {
    background: linear-gradient(145deg, var(--hawk-accent), #b917c3);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-checkout:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(206, 26, 219, 0.2);
    color: white;
}

/* Empty Cart */
.empty-cart {
    background: var(--hawk-card-bg);
    border-radius: 12px;
    padding: 3rem;
}

.empty-cart-icon {
    font-size: 4rem;
    color: var(--hawk-text-muted);
    display: block;
}

.btn-shopping {
    background: var(--hawk-bg-secondary);
    color: var(--hawk-text);
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.btn-shopping:hover {
    background: var(--hawk-accent);
    color: white;
    transform: translateY(-2px);
}

/* Alert Styles */
.alert {
    border: none;
    border-radius: 8px;
}

.alert-success {
    background: var(--hawk-success-soft);
    color: var(--hawk-success);
}

/* Dark Mode Variables */
:root {
    --hawk-danger-soft: rgba(220, 53, 69, 0.1);
    --hawk-danger: #dc3545;
    --hawk-success-soft: rgba(25, 135, 84, 0.1);
    --hawk-success: #198754;
    --hawk-text-muted: #6c757d;
    --hawk-bg-secondary: rgba(108, 117, 125, 0.1);
}

[data-bs-theme="dark"] {
    --hawk-danger-soft: rgba(255, 77, 77, 0.1);
    --hawk-danger: #ff4d4d;
    --hawk-success-soft: rgba(25, 135, 84, 0.15);
    --hawk-success: #20c997;
    --hawk-text-muted: #a1a1aa;
    --hawk-bg-secondary: rgba(108, 117, 125, 0.15);
}
</style>
@endsection
