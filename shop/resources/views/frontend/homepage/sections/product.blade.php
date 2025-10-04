<style>
    /* ===== Grid sản phẩm ===== */
    .product-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* ===== Khung ảnh ===== */
    .block2-pic {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
    }

    .block2-pic img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 12px;
        transition: transform 0.5s ease;
    }

    .block2-pic:hover img {
        transform: scale(1.08);
    }

    /* ===== Nút "Xem ngay" ===== */
    .block2-btn {
        position: absolute;
        bottom: -50px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #ff6600, #ffcc00);
        color: #fff !important;
        font-weight: 600;
        padding: 10px 25px;
        border-radius: 25px;
        opacity: 0;
        transition: all 0.4s ease;
    }

    .block2-pic:hover .block2-btn {
        bottom: 20px;
        opacity: 1;
    }

    /* ===== Tên sản phẩm ===== */
    .block2-txt a {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        transition: color 0.3s ease;
    }

    .block2-txt a:hover {
        color: #ff6600;
    }

    /* ===== Giá sản phẩm ===== */
    .product-price {
        font-size: 15px;
        margin-top: 8px;
    }

    .original-price {
        text-decoration: line-through;
        color: #999;
        margin-right: 8px;
        font-size: 14px;
    }

    .sale-price {
        color: #e60000;
        font-weight: 700;
        font-size: 16px;
    }

    .current-price {
        font-weight: 700;
        font-size: 16px;
        color: #222;
    }

    /* ===== Hiệu ứng load nhiều sản phẩm ===== */
    .hidden {
        opacity: 0;
        max-height: 0;
        overflow: hidden;
        transition: opacity 0.5s ease, max-height 0.5s ease;
    }

    .visible {
        margin-bottom: 40px;
        opacity: 1;
        max-height: 600px;
        transition: opacity 0.5s ease, max-height 0.5s ease;
    }

    /* ===== Sale badge ===== */
    .sale-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #e60000;
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ===== Brand section ===== */
    .brand-box {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin: 10px;
        text-align: center;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .brand-box img {
        max-height: 60px;
        object-fit: contain;
        filter: grayscale(100%);
        transition: all 0.3s ease-in-out;
    }

    .brand-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .brand-box:hover img {
        filter: grayscale(0%);
        transform: scale(1.1);
    }

    /* ===== Responsive ===== */
    @media (max-width: 992px) {
        .block2-pic img {
            height: 300px;
        }
    }

    @media (max-width: 576px) {
        .block2-pic img {
            height: 250px;
        }

        .block2-btn {
            padding: 8px 16px;
            font-size: 14px;
        }
    }
</style>

<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-20 mb-5 text-center">
            <h3 class="ltext-103 cl5" style="font-weight:700; font-size:28px; color:#222;">
                ✨ SẢN PHẨM NỔI BẬT ✨
            </h3>
            <p style="color:#666; font-size:15px;">Khám phá những mẫu mới nhất & hot nhất hôm nay</p>
        </div>

        <div class="row" id="product-list">
            @foreach ($products as $index => $product)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 product-item {{ $index < 8 ? 'initial' : 'hidden' }}">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset($product->thumb) }}" alt="IMG-PRODUCT">
                            @if ($product->price_sale)
                                <span class="sale-badge">SALE</span>
                            @endif
                            <a href="#"
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                                data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}" data-price-sale="{{ $product->price_sale }}"
                                data-description="{{ $product->description }}"
                                data-image="{{ asset($product->thumb) }}">
                                Xem ngay
                            </a>
                        </div>
                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l text-center">
                                <a href="{{ route('fr.product.detail', ['productID' => $product->id]) }}"
                                    class="stext-104 p-b-6">
                                    {{ $product->name }}
                                </a>
                                @if ($product->price_sale)
                                    <div class="product-price">
                                        <span class="original-price">{{ number_format($product->price, 0) }} VND</span>
                                        <span class="sale-price">{{ number_format($product->price_sale, 0) }}
                                            VND</span>
                                    </div>
                                @else
                                    <div class="product-price">
                                        <span class="current-price">{{ number_format($product->price, 0) }} VND</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Brand section -->
<section class="brand-section py-5" style="background: #f8f9fa;">
    <div class="container">
        <h3 class="text-center mb-5 fw-bold" style="letter-spacing: 1px; font-size: 26px;">
            THƯƠNG HIỆU NỔI BẬT
        </h3>
        <div class="row justify-content-center">
            @php
                $brands = ['nike', 'adidas', 'jordan', 'asics', 'babolat', 'newbalance'];
            @endphp
            @foreach ($brands as $brand)
                <div class="col-6 col-md-2 brand-item">
                    <div class="brand-box">
                        <img src="/template/admin/dist/img/{{ $brand }}.png" alt="{{ ucfirst($brand) }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
