<!-- Slider -->
<style>
    .section-slide {
    margin-top: 80px; /* cao bằng header desktop */
}
.item-slick1 {
    height: 500px; /* hoặc 500px tùy ý */
    background-size: cover;
    background-position: center;
}
    .item-slick1 {
        background-size: cover;
        /* Đảm bảo ảnh chiếm toàn bộ phần tử mà không bị biến dạng */
        background-position: center;
        /* Căn giữa ảnh */

    }

    .layer-slick1 span.ltext-101,
    .layer-slick1 h2.ltext-201 {
        /* Chữ màu trắng nổi bật trên ảnh */
        color: #ff6600;
        /* màu chữ chính, bạn thay đổi nếu muốn */

        /* Viền/outline trắng */
        text-shadow:
            2px 2px 0 #fff,
            -2px 2px 0 #fff,
            2px -2px 0 #fff,
            -2px -2px 0 #fff,
            2px 0 0 #fff,
            0 2px 0 #fff,
            -2px 0 0 #fff,
            0 -2px 0 #fff;
    }
        .features-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 60px;
        margin: 30px auto;
        padding: 20px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        max-width: 1200px;
    }

    .feature-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        font-size: 15px;
        font-weight: 500;
        color: #000;
    }

    .feature-item img {
        width: 48px;
        height: 48px;
        margin-bottom: 8px;
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
                                <a href="{{ $slider->url }}" target="_blank"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
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
<!-- Thanh icon dưới slider -->
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
