@extends('frontend.shared.frontend_theme')
@section('title', 'Sepetim')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="fas fa-shopping-cart me-2"></i>Sepetim
            </h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($cartItems->count() > 0)
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
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
                                    @php $total = 0; @endphp
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->product->images->count() > 0)
                                                        <img src="{{ asset('storage/products/' . $item->product->images[0]->image_url) }}"
                                                             alt="{{ $item->product->name }}"
                                                             style="width: 50px; height: 50px; object-fit: cover"
                                                             class="me-3">
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
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @php $total += $item->product->price * $item->quantity; @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Toplam:</strong></td>
                                        <td colspan="2"><strong>{{ number_format($total, 2) }} TL</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('checkout.form') }}" class="btn btn-primary float-end">
                            <i class="fas fa-credit-card me-2"></i>Ödemeye Geç
                        </a>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Sepetinizde ürün bulunmamaktadır.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
