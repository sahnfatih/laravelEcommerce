<div class="product-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
    @if($product->discount > 0)
        <div class="discount-badge">%{{$product->discount}}</div>
    @endif
    <div class="product-image">
        <img src="{{$product->image}}" alt="{{$product->name}}">
        <div class="product-actions">
            @auth
                <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="action-btn add-to-cart">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('signin.form') }}" class="action-btn add-to-cart">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            @endauth
        </div>
    </div>
    <div class="product-details">
        <h3>{{$product->name}}</h3>
        <div class="product-price">
            @if($product->discount > 0)
                <span class="old-price">{{number_format($product->original_price, 2)}} TL</span>
            @endif
            <span class="current-price">{{number_format($product->price, 2)}} TL</span>
        </div>
    </div>
</div>
