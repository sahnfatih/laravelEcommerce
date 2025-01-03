@extends('frontend.shared.frontend_theme')
@section('title', isset($selectedCategory) ? $selectedCategory->name : 'Anasayfa')

@section('content')
<div class="container">
    <div class="row">
        <!-- Kategoriler -->
        <div class="col-md-3">
            <h5 class="mb-3">
                <i class="fas fa-tags me-2"></i>Kategoriler
            </h5>
            <div class="list-group">
                <a href="{{ route('home') }}"
                   class="list-group-item list-group-item-action {{ !isset($selectedCategory) ? 'active' : '' }}">
                    Tüm Ürünler
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('category.index', $category->slug) }}"
                       class="list-group-item list-group-item-action {{ isset($selectedCategory) && $selectedCategory->category_id == $category->category_id ? 'active' : '' }}">
                        {{ $category->name }}
                        <small class="text-muted">({{ $category->products_count ?? 0 }})</small>
                    </a>
                    @if($category->children && $category->children->count() > 0)
                        @foreach($category->children as $child)
                            <a href="{{ route('category.index', $child->slug) }}"
                               class="list-group-item list-group-item-action ps-4 {{ isset($selectedCategory) && $selectedCategory->category_id == $child->category_id ? 'active' : '' }}">
                                {{ $child->name }}
                                <small class="text-muted">({{ $child->products_count ?? 0 }})</small>
                            </a>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Ürünler -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5>
                    {{ isset($selectedCategory) ? $selectedCategory->name : 'Tüm Ürünler' }}
                    <small class="text-muted">({{ $products->count() }} ürün)</small>
                </h5>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-sort me-2"></i>Sırala
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                        <li>
                            <a class="dropdown-item {{ $sortBy == 'default' ? 'active' : '' }}"
                               href="{{ request()->fullUrlWithQuery(['sort_by' => 'default']) }}">
                                Varsayılan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ $sortBy == 'price_asc' ? 'active' : '' }}"
                               href="{{ request()->fullUrlWithQuery(['sort_by' => 'price_asc']) }}">
                                Fiyat (Düşükten Yükseğe)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ $sortBy == 'price_desc' ? 'active' : '' }}"
                               href="{{ request()->fullUrlWithQuery(['sort_by' => 'price_desc']) }}">
                                Fiyat (Yüksekten Düşüğe)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ $sortBy == 'name_asc' ? 'active' : '' }}"
                               href="{{ request()->fullUrlWithQuery(['sort_by' => 'name_asc']) }}">
                                İsim (A-Z)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ $sortBy == 'name_desc' ? 'active' : '' }}"
                               href="{{ request()->fullUrlWithQuery(['sort_by' => 'name_desc']) }}">
                                İsim (Z-A)
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ $sortBy == 'newest' ? 'active' : '' }}"
                               href="{{ request()->fullUrlWithQuery(['sort_by' => 'newest']) }}">
                                En Yeniler
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ $sortBy == 'discount' ? 'active' : '' }}"
                               href="{{ request()->fullUrlWithQuery(['sort_by' => 'discount']) }}">
                                İndirim Oranı
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                @forelse($products as $product)
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
                                    <div class="text-end">
                                        @if($product->discount_rate > 0)
                                            <small class="text-decoration-line-through text-muted">
                                                {{ number_format($product->original_price, 2) }} TL
                                            </small>
                                            <br>
                                        @endif
                                        <span class="text-primary fw-bold">{{ number_format($product->price, 2) }} TL</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                @auth
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-shopping-cart me-2"></i>Sepete Ekle
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('signin.form') }}" class="btn btn-primary w-100">
                                        <i class="fas fa-shopping-cart me-2"></i>Sepete Ekle
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Bu kategoride henüz ürün bulunmamaktadır.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


@endsection
