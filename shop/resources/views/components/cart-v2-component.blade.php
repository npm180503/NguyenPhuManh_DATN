<style>
    /* ===== Cart Panel (luxury) ===== */
    .wrap-header-cart .header-cart {
        max-width: 560px;
        /* rộng hơn để chữ không gãy dòng */
        background: #fff;
        border-left: 1px solid #eee;
        box-shadow: -18px 0 40px rgba(0, 0, 0, .06);
        padding-left: 24px;
        padding-right: 16px;
    }

    /* Header */
    .header-cart-title {
        padding: 20px 0;
        border-bottom: 1px solid #f0f0f3;
        margin: 0 4px
    }

    .header-cart-title .mtext-103 {
        font-weight: 800;
        letter-spacing: .6px;
        color: #111
    }

    .header-cart-title .js-hide-cart {
        color: #111;
        opacity: .6;
        transition: .2s
    }

    .header-cart-title .js-hide-cart:hover {
        opacity: 1;
        transform: scale(1.05)
    }

    /* Content area */
    .header-cart-content {
        padding: 14px 0 128px
    }

    /* chừa chỗ cho footer sticky */
    .header-cart-wrapitem {
        width: 100%;
        padding: 0 16px;
        margin: 0
    }

    /* ===== Item ===== */
    .header-cart-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        width: 100%;
        margin: 12px 0;
        padding: 12px;
        border: 1px solid #eee;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 6px 16px rgba(0, 0, 0, .05);
        transition: transform .15s, box-shadow .15s;
    }

    .header-cart-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(0, 0, 0, .08)
    }

    .header-cart-item-img {
        flex: 0 0 90px;
        width: 90px;
        height: 90px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #eee
    }

    .header-cart-item-img img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .header-cart-item-txt {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-width: 0
    }

    .header-cart-item-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 8px
    }

    .header-cart-item-name {
        font-weight: 700;
        color: #111;
        font-size: 1rem;
        line-height: 1.3;
        text-decoration: none;
        display: block;
        max-width: 100%;
    }

    .header-cart-item-name:hover {
        color: #c6a353
    }

    /* remove button */
    .btn-remove-cart {
        background: none;
        border: 0;
        color: #b42318;
        font-size: 18px;
        cursor: pointer;
        width: 32px;
        height: 32px;
        border-radius: 999px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .btn-remove-cart:hover {
        background: #fff1f1;
        color: #a10f08;
        box-shadow: 0 0 0 2px #fee2e2 inset
    }

    /* price line */
    .header-cart-item-info {
        margin-top: 8px;
        color: #6b7280;
        font-size: .95rem
    }

    .header-cart-item-info .price {
        color: #111;
        font-weight: 700
    }

    /* ===== Footer sticky ===== */
    .header-cart-footer {
        position: sticky;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(180deg, rgba(255, 255, 255, .2), #fff 30%, #fff);
        border-top: 1px solid #f0f0f3;
        padding: 16px 18px 20px;
        margin-top: 10px
    }

    .header-cart-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        color: #6b7280;
        font-weight: 600
    }

    #cart-total {
        font-size: 1.25rem;
        color: #dc2626;
        font-weight: 800
    }

    /* CTA vàng champagne */
    .btn-cart-gold {
        display: block;
        width: 100%;
        text-align: center;
        padding: 1rem 1rem;
        border: none;
        border-radius: 14px;
        font-weight: 800;
        letter-spacing: .4px;
        color: #111;
        text-transform: uppercase;
        background: linear-gradient(135deg, #d4af37, #c6a353, #a9852e);
        box-shadow: 0 8px 22px rgba(198, 163, 83, .28);
        transition: .25s;
    }

    .btn-cart-gold:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(198, 163, 83, .35)
    }

    /* Empty states */
    .header-cart-empty {
        padding: 40px 16px;
        text-align: center;
        color: #6b7280
    }

    .header-cart-empty a {
        color: #c6a353;
        font-weight: 700;
        text-decoration: none
    }

    .header-cart-empty a:hover {
        filter: brightness(1.05)
    }
</style>

<div>
    <div @class([
        'icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart',
        'icon-header-noti' => !empty($cart->content()),
    ])
        @if (!empty($cart->content())) data-notify="{{ count($cart->content()) }}" @endif>
        <i class="zmdi zmdi-shopping-cart"></i>
    </div>

    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <!-- Header -->
            <div class="header-cart-title flex-w flex-sb-m">
                <span class="mtext-103 cl2">Giỏ hàng của bạn</span>
                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <!-- Body -->
            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full" id="cart-items">
                    @if (auth('frontend')->check())
                        @if (!empty($cart->content()))
                            @foreach ($cart->content() as $key => $item)
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="{{ $item->product->thumb ?? asset('images/no-image.png') }}"
                                            alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <div class="header-cart-item-row">
                                            <a href="#" class="header-cart-item-name hov-cl1 trans-04">
                                                {{ $item->product?->name ?? 'Không có sản phẩm' }}
                                                ({{ $item->size?->name ?? '' }})
                                            </a>
                                            <button class="btn-remove-cart" data-url="{{ route('cart.remove', $key) }}"
                                                data-rowid="{{ $key }}">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>

                                        <span class="header-cart-item-info">
                                            {{ $item->quantity }} ×
                                            @if ($item->product)
                                                <span class="price">{{ number_format($item->price) }} VND</span>
                                            @else
                                                <span class="text-danger">Sản phẩm không tồn tại</span>
                                            @endif
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="header-cart-empty">Giỏ hàng trống.</li>
                        @endif
                    @else
                        <li class="header-cart-empty">
                            Vui lòng <a href="{{ route('fr.login') }}">đăng nhập</a> để xem giỏ hàng.
                        </li>
                    @endif
                </ul>

                <!-- Footer -->
                <div class="header-cart-footer w-full">
                    <div class="header-cart-total">
                        <span>Tổng cộng:</span>
                        <strong id="cart-total">{{ $cart->total() }} VND</strong>
                    </div>
                    <a href="{{ route('cart.detail') }}" class="btn-cart-gold">Xem chi tiết giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
