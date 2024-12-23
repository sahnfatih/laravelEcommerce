@extends("backend.shared.backend_theme")
@section("title","Kullanıcı Modülü")
@section("subtitle","Kullanıcı Güncelle")
@section("btn_url",url()->previous())
@section("btn_label","Geri Dön")
@section("btn_icon","arrow-left")
@section("content")
<form action="{{url("/users/$user->user_id")}}" method="POST" autocomplete="off">
    @csrf
    @method("PUT")
    <div class="row">
        <div class="col-lg-6">
            <div class="mt-2">
                <label for="name" class="form-label">Ad Soyad</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{old('name', $user->name)}}" placeholder="Ad soyad giriniz">
                @error("name")
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mt-2">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{old('email', $user->email)}}" placeholder="E-posta giriniz">
                @error("email")
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin" value="1"
                       {{$user->is_admin ? 'checked' : ''}}>
                <label class="form-check-label" for="is_admin">Yetkili Kullanıcı</label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                       {{$user->is_active ? 'checked' : ''}}>
                <label class="form-check-label" for="is_active">Aktif Kullanıcı</label>
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
