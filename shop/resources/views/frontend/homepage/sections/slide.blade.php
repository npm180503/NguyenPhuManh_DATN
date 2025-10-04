<!-- Slider -->
<style>
/* ===== Slider Section ===== */
.section-slide {
    margin-top: 30px;
}

.item-slick1 {
    height: 550px; /* cao hơn để đẹp hơn */
    background-size: cover;
    background-position: center;
    position: relative;
    overflow: hidden;
    border-radius: 20px; /* bo góc nhẹ */
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transition: transform 0.5s ease;
}

.item-slick1:hover {
    transform: scale(1.02);
}

.layer-slick1 span.ltext-101,
.layer-slick1 h2.ltext-201 {
    color: #fff;
    text-shadow: 0 0 10px rgba(0,0,0,0.7);
}

.layer-slick1 span.ltext-101 {
    font-size: 20px;
    font-weight: 500;
    letter-spacing: 1px;
}

.layer-slick1 h2.ltext-201 {
    font-size: 50px;
    font-weight: 700;
    margin-top: 10px;
}

.layer-slick1 a {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 30px;
    font-weight: 600;
    font-size: 16px;
    color: #fff;
    background: linear-gradient(135deg, #ff6600, #ffcc00);
    border-radius: 50px;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.layer-slick1 a:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
}

/* ===== Features Bar ===== */
.features-bar {
    display: flex;
    justify-content: center;
    align-items: stretch;
    gap: 40px;
    margin: 50px auto;
    padding: 20px;
    max-width: 1200px;
    flex-wrap: wrap;
}

.feature-item {
    flex: 1;
    min-width: 180px;
    background: linear-gradient(135deg, #fff8f0, #fff3e0);
    border-radius: 15px;
    text-align: center;
    padding: 20px;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.feature-item img {
    width: 60px;
    height: 60px;
    margin-bottom: 12px;
    transition: transform 0.3s ease;
}

.feature-item:hover img {
    transform: scale(1.2);
}

.feature-item span {
    display: block;
    font-weight: 600;
    font-size: 14px;
    color: #333;
}
</style>

<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            @foreach ($sliders as $slider)
                <div class="item-slick1" style="background-image: url({{ asset($slider->thumb) }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    {{ $slider->description }}
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    {{ $slider->name }}
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="{{ $slider->url }}" target="_blank">
                                    Xem ngay
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Bar -->
<div class="features-bar">
    <div class="feature-item">
        <img src="/template/admin/dist/img/doi-mau-doi-size-mien-phi.jpg" alt="Đổi mẫu">
        <span>Đổi mẫu, đổi size miễn phí</span>
    </div>
    <div class="feature-item">
        <img src="/template/admin/dist/img/mua-truoc-tra-sau-mien-lai.jpg" alt="Mua trước">
        <span>Mua trước, trả sau miễn lãi</span>
    </div>
    <div class="feature-item">
        <img src="/template/admin/dist/img/giao-hang-doi-tra-tan-nha.jpg" alt="Giao hàng">
        <span>Giao hàng, đổi trả tận nhà</span>
    </div>
    <div class="feature-item">
        <img src="/template/admin/dist/img/hang-gia-den-tien-gap-doi.jpg" alt="Đền tiền">
        <span>Hàng giả, đền tiền gấp đôi</span>
    </div>
</div>
