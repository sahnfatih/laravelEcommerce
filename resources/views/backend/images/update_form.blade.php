@extends("backend.shared.backend_theme")
@section("title","Ürün Resim Modülü")
@section("subtitle","Resim Güncelle")
@section("btn_url",url()->previous())
@section("btn_label","Geri Dön")
@section("btn_icon","arrow-left")
@section("content")
    <form action="{{url("/products/$product->product_id/images/$image->image_id")}}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="hidden" name="product_id" value="{{$product->product_id}}">
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="image_url" class="form-label">Resim Seçiniz</label>
                    <input type="file" class="form-control" id="image_url" name="image_url">
                    @error("image_url")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    @if($image->image_url != "")
                        <img src="{{asset("/storage/products/" . $image->image_url)}}" alt="{{$image->alt}}"
                             style="height: 100px" class="mt-3">
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="alt" class="form-label">Resim Açıklaması</label>
                    <input type="text" class="form-control" id="alt" name="alt"
                           value="{{old('alt', $image->alt)}}" placeholder="Resim açıklaması giriniz">
                    @error("alt")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mt-2">
                    <label for="seq" class="form-label">Sıra No</label>
                    <input type="number" class="form-control" id="seq" name="seq"
                           value="{{old('seq', $image->seq)}}" placeholder="Sıra no giriniz">
                    @error("seq")
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="is_active"
                           name="is_active" value="1" {{$image->is_active == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="is_active">Aktif Resim</label>
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
