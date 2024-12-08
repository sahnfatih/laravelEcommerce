@extends("backend.shared.backend_theme")
@section("title","Kullanıcı Adres Modülü")
@section("subtitle","Adres Güncelle")
@section("btn_url",route('users.addresses.index', $user->user_id))
@section("btn_label","Geri Dön")
@section("btn_icon","arrow-left")
@section("content")
    <form action="{{url("/users/$user->user_id/addresses/$addr->address_id")}}" method="POST" autocomplete="off">
        @csrf
        @method("PUT")
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="city" class="form-label">Şehir</label>
                    <input type="text" class="form-control" id="city" name="city"
                           value="{{old('city', $addr->city)}}" placeholder="Şehir giriniz">
                    @error("city")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="district" class="form-label">İlçe</label>
                    <input type="text" class="form-control" id="district" name="district"
                           value="{{old('district', $addr->district)}}" placeholder="İlçe giriniz">
                    @error("district")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="zipcode" class="form-label">Posta Kodu</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode"
                           value="{{old('zipcode', $addr->zipcode)}}" placeholder="Posta kodu giriniz">
                    @error("zipcode")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="is_default"
                           name="is_default" value="1" {{$addr->is_default == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="is_default">Varsayılan Adres</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="mt-2">
                    <label for="address" class="form-label">Açık Adres</label>
                    <textarea class="form-control" id="address" name="address"
                              placeholder="Açık adres giriniz">{{old('address', $addr->address)}}</textarea>
                    @error("address")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary mt-2">
                    <span data-feather="save"></span> KAYDET
                </button>
            </div>
        </div>
    </form>
@endsection
