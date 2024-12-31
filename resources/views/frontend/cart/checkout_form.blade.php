@extends('frontend.shared.frontend_theme')
@section('title', 'Ödeme')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        <i class="fas fa-credit-card me-2"></i>Ödeme Bilgileri
                    </h4>
                    <form action="{{url("/odeme")}}" method="POST" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="card_holder" class="form-label">Kart Üzerindeki İsim</label>
                                <input type="text" class="form-control @error('card_holder') is-invalid @enderror"
                                       id="card_holder" name="card_holder" required>
                                @error('card_holder')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="card_number" class="form-label">Kart Numarası</label>
                                <input type="text" class="form-control @error('card_number') is-invalid @enderror"
                                       id="card_number" name="card_number" required>
                                @error('card_number')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="expiry_month" class="form-label">Son Kullanma Ay</label>
                                <select class="form-select @error('expiry_month') is-invalid @enderror"
                                        id="expiry_month" name="expiry_month" required>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{sprintf('%02d', $i)}}">{{sprintf('%02d', $i)}}</option>
                                    @endfor
                                </select>
                                @error('expiry_month')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="expiry_year" class="form-label">Son Kullanma Yıl</label>
                                <select class="form-select @error('expiry_year') is-invalid @enderror"
                                        id="expiry_year" name="expiry_year" required>
                                    @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                @error('expiry_year')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control @error('cvv') is-invalid @enderror"
                                       id="cvv" name="cvv" required>
                                @error('cvv')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check me-2"></i>Ödemeyi Tamamla
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Sipariş Özeti</h5>
                    @if(isset($cart) && count($cart) > 0)
                        @foreach($cart as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{$item['name']}} x {{$item['quantity']}}</span>
                                <span>{{number_format($item['price'] * $item['quantity'], 2)}} TL</span>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ara Toplam</span>
                            <span>{{number_format($total, 2)}} TL</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>KDV (%18)</span>
                            <span>{{number_format($total * 0.18, 2)}} TL</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Genel Toplam</strong>
                            <strong>{{number_format($total * 1.18, 2)}} TL</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
