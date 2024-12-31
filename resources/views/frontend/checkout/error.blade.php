@extends('frontend.shared.frontend_theme')
@section('title', 'Ödeme Başarısız')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
                    </div>
                    <h4 class="card-title mb-3">Ödeme Başarısız!</h4>
                    <p class="card-text">
                        {{$error_message ?? 'Ödeme işlemi sırasında bir hata oluştu.'}}
                    </p>
                    <p class="text-muted">
                        Lütfen bilgilerinizi kontrol edip tekrar deneyiniz.
                    </p>
                    <a href="/odeme" class="btn btn-primary">
                        <i class="fas fa-redo me-2"></i>Tekrar Dene
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
