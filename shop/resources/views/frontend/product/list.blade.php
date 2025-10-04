<style>
    /* ===== Product Grid ===== */
    .product-item {
        position: relative;
        margin-bottom: 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .block2 {
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        transition: all 0.3s ease;
    }

    .block2-pic {
        position: relative;
        overflow: hidden;
    }

    .block2-pic img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .block2-pic:hover img {
        transform: scale(1.1);
    }

    .block2-btn {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 20px;
        border-radius: 25px;
        background: linear-gradient(135deg, #ff6600, #ffcc00);
        color: #fff;
        font-weight: bold;
        opacity: 0;
        transition: opacity 0.3s ease, transform 0.3s ease;
        text-align: center;
    }

    .block2-pic:hover .block2-btn {
        opacity: 1;
        transform: translateX(-50%) translateY(-5px);
    }

    .block2-txt {
        padding: 15px;
        text-align: center;
    }

    .block2-txt-child1 a {
        display: block;
        font-weight: 600;
        color: #333;
        font-size: 16px;
        margin-bottom: 8px;
        transition: color 0.3s;
    }

    .block2-txt-child1 a:hover {
        color: #ff6600;
    }

    .original-price {
        text-decoration: line-through;
        color: #999;
        margin-right: 8px;
        font-size: 14px;
    }

    .sale-price {
        color: #e60000;
        font-weight: bold;
        font-size: 16px;
    }

    .current-price {
        font-weight: bold;
        color: #333;
        font-size: 16px;
    }

    /* ===== SALE Badge ===== */
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

    /* Responsive */
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

<div class="row">
    @if ($products->count() > 0)
        @foreach ($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 product-item menu-{{ $product->menu_id }} {{ $product->price_sale ? 'sale' : '' }}"
                data-price="{{ $product->price_sale ?? $product->price }}" data-date="{{ $product->created_at }}">
                <div class="block2">
                    <div class="block2-pic">
                        <img src="{{ asset($product->thumb) }}" alt="{{ $product->name }}">
                        @if ($product->price_sale)
                            <span class="sale-badge">SALE</span>
                        @endif
                        <a href="{{ route('fr.product.detail', ['productID' => $product->id]) }}" class="block2-btn">Xem
                            ngay</a>
                    </div>
                    <div class="block2-txt">
                        <div class="block2-txt-child1">
                            <a href="{{ route('fr.product.detail', ['productID' => $product->id]) }}">
                                {{ $product->name }}
                            </a>
                            @if ($product->price_sale)
                                <span class="original-price">{{ number_format($product->price, 0) }} VND</span>
                                <span class="sale-price">{{ number_format($product->price_sale, 0) }} VND</span>
                            @else
                                <span class="current-price">{{ number_format($product->price, 0) }} VND</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center" style="font-size:18px; color:#999;">Không có sản phẩm nào!</p>
    @endif
</div>
