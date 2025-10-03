<!-- Banner - Tin tức mới nhất -->
<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Tin tức mới nhất</h2>
        <div class="row">
            @foreach($latestNews as $item)
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 news-card">
                        <div class="position-relative">
                            <a href="{{ route('fr.new.show', ['id' => $item->id, 'slug' => \Str::slug($item->title)]) }}">
                                <img src="{{ asset($item->thumb) }}" class="card-img-top rounded news-img" alt="{{ $item->title }}">
                                <div class="news-overlay d-flex flex-column justify-content-end p-3">
                                    <h5 class="text-white fw-bold mb-2">{{ \Str::limit($item->title, 60) }}</h5>
                                    <p class="mb-0 text-light small">
                                        <i class="far fa-calendar-alt"></i> {{ $item->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    .news-card {
    overflow: hidden;
    border-radius: 12px;
    transition: transform 0.3s ease-in-out;
}
.news-card:hover {
    transform: translateY(-5px);
}

.news-img {
    height: 250px;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.news-card:hover .news-img {
    transform: scale(1.05);
}

.news-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0));
    height: 100%;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}
.news-card:hover .news-overlay {
    opacity: 1;
}

</style>