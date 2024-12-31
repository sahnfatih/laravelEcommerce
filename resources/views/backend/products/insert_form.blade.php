@extends("backend.shared.backend_theme")
@section("title","Ürün Modülü")
@section("subtitle","Yeni Ürün Ekle")
@section("btn_url",url()->previous())
@section("btn_label","Geri Dön")
@section("btn_icon","arrow-left")
@section("content")
    <form action="{{url("/products")}}" method="POST" autocomplete="off" novalidate>
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="name" class="form-label">Ürün Adı</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{old('name')}}" placeholder="Ürün adı giriniz">
                    @error("name")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="category_id" class="form-label">Kategori Seçiniz</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="-1">Seçiniz</option>
                        @foreach($categories as $category)
                            <option value="{{$category->category_id}}" {{old('category_id') == $category->category_id ? 'selected' : ''}}>
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                    @error("category_id")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="price" class="form-label">Ürün Fiyatı</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                           value="{{old('price')}}" placeholder="Fiyat giriniz">
                    @error("price")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="old_price" class="form-label">Eski Fiyat</label>
                    <input type="number" step="0.01" class="form-control" id="old_price" name="old_price"
                           value="{{old('old_price')}}" placeholder="Eski fiyat giriniz">
                    @error("old_price")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="mt-2">
                    <label for="lead" class="form-label">Kısa Açıklama</label>
                    <input type="text" class="form-control" id="lead" name="lead"
                           value="{{old('lead')}}" placeholder="Kısa açıklama giriniz">
                    @error("lead")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="mt-2">
                    <label for="description" class="form-label">Detaylı Açıklama</label>
                    <textarea class="form-control" id="description" name="description"
                              placeholder="Detaylı açıklama giriniz">{{old('description')}}</textarea>
                    @error("description")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="is_active"
                           name="is_active" value="1" {{old('is_active') ? 'checked' : ''}}>
                    <label class="form-check-label" for="is_active">Aktif Ürün</label>
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
