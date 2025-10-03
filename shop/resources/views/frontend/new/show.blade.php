@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- Tiêu đề -->
            <h1 class="fw-bold mb-3 text-center">{{ $news->title }}</h1>

            <!-- Ngày đăng -->
            <p class="text-muted text-center">
                <i class="far fa-calendar-alt"></i>
                Ngày đăng: {{ $news->created_at->format('d/m/Y') }}
            </p>

            <!-- Ảnh đại diện -->
            @if ($news->thumb)
                <div class="text-center mb-4 ">
                    <img src="{{ asset($news->thumb) }}" class="img-fluid rounded shadow-sm"
                         alt="{{ $news->title }}" style="max-height: 450px; object-fit: cover;">
                </div>
            @endif

            <!-- Nội dung -->
            <div class="news-content fs-5 lh-lg">
                {!! $news->content !!}
            </div>

            <!-- Quay lại -->
            <div class="mt-4 text-center">
                <a href="{{ route('fr.new') }}" class="btn btn-outline-primary">
                    ← Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.news-content {
    font-size: 1.1rem; /* chữ to hơn */
    line-height: 1.8;  /* giãn dòng thoáng */
    color: #333;
}

.news-content img {
    max-width: 100%;   /* ảnh không vượt quá khung */
    height: auto;      /* giữ tỉ lệ ảnh */
    display: block;
    margin: 15px auto; /* căn giữa ảnh */
    border-radius: 6px;
}

</style>
@endsection
