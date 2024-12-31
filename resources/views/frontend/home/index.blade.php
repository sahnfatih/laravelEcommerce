@extends('frontend.shared.frontend_theme')
@section('title', isset($category) ? $category->name : 'Anasayfa')

@section('content')
<div class="container">
    <div class="row">
        <!-- Kategoriler -->
        <div class="col-md-3">
            <h5 class="mb-3">
                <i class="fas fa-tags me-2"></i>Tüm Ürünler
            </h5>
            <div class="list-group">
                @foreach($categories as $category)
                    <a href="#" class="list-group-item list-group-item-action">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Ürünler -->
        <div class="col-md-9">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="card-img-top"
                                 alt="{{ $product->name }}"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary">{{ $product->category->name }}</span>
                                    <span class="text-primary fw-bold">{{ number_format($product->price, 2) }} TL</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="#" class="btn btn-primary w-100">
                                    <i class="fas fa-sign-in-alt me-2"></i>Giriş Yapın
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
.card {
    background-color: #1a1a1a;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.list-group-item {
    background-color: #1a1a1a;
    border-color: rgba(255, 255, 255, 0.1);
    color: white;
}

.list-group-item:hover {
    background-color: #2d2d2d;
    color: white;
}

.card-title {
    color: white;
}

.card-text {
    color: rgba(255, 255, 255, 0.8);
}

.btn-primary {
    background-color: #7c3aed;
    border-color: #7c3aed;
}

.btn-primary:hover {
    background-color: #6d28d9;
    border-color: #6d28d9;
}

.badge.bg-primary {
    background-color: #7c3aed !important;
}
</style>
@endsection
