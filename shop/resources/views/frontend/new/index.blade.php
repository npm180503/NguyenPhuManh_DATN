@extends('frontend.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">📰 Tin tức mới nhất</h2>
    
    <div class="row g-4">
        @foreach ($news as $item)
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                    <a href="{{ route('fr.new.show', ['id' => $item->id, 'slug' => \Str::slug($item->title)]) }}">
                        <img src="{{ asset($item->thumb) }}" class="card-img-top" alt="{{ $item->title }}"
                             style="height: 220px; object-fit: cover; transition: 0.3s;">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold mb-2">
                            <a href="{{ route('fr.new.show', ['id' => $item->id, 'slug' => \Str::slug($item->title)]) }}" 
                               class="text-decoration-none text-dark hover-text-primary">
                                {{ $item->title }}
                            </a>
                        </h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ \Str::limit(strip_tags($item->content), 120) }}
                        </p>
                        <a href="{{ route('fr.new.show', ['id' => $item->id, 'slug' => \Str::slug($item->title)]) }}" 
                           class="btn btn-outline-primary mt-2 align-self-start">
                            Đọc thêm →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $news->links() }}
    </div>
</div>

<style>
    .card img:hover {
        transform: scale(1.05);
    }
    .hover-text-primary:hover {
        color: #0d6efd !important;
    }
</style>
@endsection
