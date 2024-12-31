@extends("backend.shared.backend_theme")
@section("title","Kategori Modülü")
@section("subtitle","Kategori Güncelle")
@section("btn_url",url()->previous())
@section("btn_label","Geri Dön")
@section("btn_icon","arrow-left")
@section("content")
    <form action="{{url("/categories/$category->category_id")}}" method="POST" autocomplete="off">
        @csrf
        @method("PUT")
        <input type="hidden" name="category_id" value="{{$category->category_id}}">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="name" class="form-label">Kategori Adı</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{old('name', $category->name)}}" placeholder="Kategori adı giriniz">
                    @error("name")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug"
                           value="{{old('slug', $category->slug)}}" placeholder="Slug giriniz">
                    @error("slug")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="is_active"
                           name="is_active" value="1" {{$category->is_active == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="is_active">Aktif Kategori</label>
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
