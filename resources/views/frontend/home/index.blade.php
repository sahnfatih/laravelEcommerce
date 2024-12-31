@extends('frontend.shared.frontend_theme')
@section('title', 'Anasayfa')
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="category-sidebar">
                <h5 class="mb-3"><i class="fas fa-tags me-2"></i>Kategoriler</h5>
                <div class="list-group">
                    <a href="/" class="list-group-item list-group-item-action {{!request()->segment(2) ? 'active' : ''}}">
                        <i class="fas fa-border-all me-2"></i>Tüm Ürünler
                    </a>
                    @if(count($categories) > 0)
                        @foreach($categories as $category)
                            <a href="/kategori/{{$category->slug}}"
                               class="list-group-item list-group-item-action {{request()->segment(2) == $category->slug ? 'active' : ''}}">
                                <i class="fas fa-angle-right me-2"></i>{{$category->name}}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4><i class="fas fa-box-open me-2"></i>Ürünler</h4>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-sort-amount-down"></i> Sırala
                    </button>
                </div>
            </div>

            @if(count($products) > 0)
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($products as $product)
                        <div class="col">
                            <div class="card h-100 product-card">
                                @if(count($product->images) > 0)
                                    <img src="{{asset("/storage/products/".$product->images[0]->image_url)}}"
                                         class="card-img-top" alt="{{$product->images[0]->alt}}"
                                         style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{$product->name}}</h5>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-primary">{{$product->category->name}}</span>
                                        @if($product->old_price)
                                            <small class="text-decoration-line-through text-muted">
                                                {{number_format($product->old_price, 2)}} TL
                                            </small>
                                        @endif
                                    </div>
                                    <h6 class="card-subtitle mb-2 text-primary fw-bold">
                                        {{number_format($product->price, 2)}} TL
                                    </h6>
                                    <p class="card-text">{{Str::limit($product->lead, 100)}}</p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <a href="/sepetim/ekle/{{$product->product_id}}"
                                       class="btn btn-primary w-100">
                                        <i class="fas fa-cart-plus me-2"></i>Sepete Ekle
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Henüz ürün eklenmemiş.
                </div>
            @endif
        </div>
    </div>
@endsection
