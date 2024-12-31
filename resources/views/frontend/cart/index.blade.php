@extends('frontend.shared.frontend_theme')
@section('title', 'Sepetim')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="fas fa-shopping-cart me-2"></i>Sepetim
                    </h4>
                    @if(isset($cart) && count($cart) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Ürün</th>
                                    <th>Fiyat</th>
                                    <th>Adet</th>
                                    <th>Toplam</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if(isset($item['image']))
                                                    <img src="{{asset("/storage/products/".$item['image'])}}"
                                                         alt="{{$item['name']}}" style="width: 50px; height: 50px; object-fit: cover"
                                                         class="me-3">
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{$item['name']}}</h6>
                                                    <small class="text-muted">{{$item['category']}}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{number_format($item['price'], 2)}} TL</td>
                                        <td>
                                            <div class="input-group" style="width: 120px">
                                                <a href="/sepetim/azalt/{{$item['id']}}" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                                <input type="text" class="form-control text-center" value="{{$item['quantity']}}" readonly>
                                                <a href="/sepetim/artir/{{$item['id']}}" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{number_format($item['price'] * $item['quantity'], 2)}} TL</td>
                                        <td>
                                            <a href="/sepetim/sil/{{$item['id']}}" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Sepetinizde ürün bulunmamaktadır.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Sipariş Özeti</h5>
                    @if(isset($cart) && count($cart) > 0)
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ara Toplam</span>
                            <span>{{number_format($total, 2)}} TL</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>KDV (%18)</span>
                            <span>{{number_format($total * 0.18, 2)}} TL</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Genel Toplam</strong>
                            <strong>{{number_format($total * 1.18, 2)}} TL</strong>
                        </div>
                        <a href="/odeme" class="btn btn-primary w-100">
                            <i class="fas fa-credit-card me-2"></i>Ödemeye Geç
                        </a>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Sepetinizde ürün bulunmamaktadır.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
