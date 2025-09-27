<style>
    .header-cart-item i {
        display: flex;
        align-items: center;
    }

    .header-cart-item-txt {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .header-cart-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-remove-cart {
        background: none;
        border: none;
        color: red;
        font-size: 18px;
        cursor: pointer;
    }

    .header-cart-item p {
        font-size: 16px;
        color: #555;
    }

    .header-cart-item a {
        color: #ff6b6b;
        text-decoration: underline;
        font-weight: bold;
    }

    .header-cart-item a:hover {
        color: #e63946;
        text-decoration: none;
    }
</style>
<div>
    <div 
        @class(['icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart', 'icon-header-noti' => $cartItems->count() > 0])
        @if ($cartItems->count() > 0) data-notify="{{ $cartItems->count() }}" @endif>
        <i class="zmdi zmdi-shopping-cart"></i>
    </div>
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>
        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">Giỏ hàng của bạn</span>
                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>
            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full" id="cart-items">
                    @if (auth('frontend')->check())
                        @if ($cartItems->count() > 0)
                            @foreach ($cartItems as $item)
                                <li class="header-cart-item flex-w flex-t m-b-12">
                                    <div class="header-cart-item-img">
                                        <img src="{{ $item->product->thumb ?? asset('images/no-image.png') }}"
                                            alt="IMG">

                                    </div>
                                    <div class="header-cart-item-txt p-t-8 flex-grow-1">
                                        <div class="header-cart-item-row">
                                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                                {{ $item->product?->name ?? 'Không có sản phẩm' }}
                                                ({{ $item->size?->name ?? '' }})

                                            </a>
                                            <button class="btn-remove-cart"
                                                data-url="{{ route('cart.remove', $item->id) }}"
                                                data-rowid="{{ $item->id }}">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <span class="header-cart-item-info">
                                            {{ $item->quantity }} x
                                            @if ($item->product)
                                                @if ($item->product->price_sale && $item->product->price_sale < $item->product->price)
                                                    <span
                                                        class="price_sale">{{ number_format($item->product->price_sale) }}
                                                        VND</span>
                                                @else
                                                    <span class="price">{{ number_format($item->product->price) }}
                                                        VND</span>
                                                @endif
                                            @else
                                                <span class="text-danger">Sản phẩm không tồn tại</span>
                                            @endif

                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="header-cart-item flex-w flex-t m-b-12">
                                <div class="header-cart-item-txt p-t-8">
                                    <span class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                        Giỏ hàng trống.
                                    </span>
                                </div>
                            </li>
                        @endif
                    @else
                        <!-- Nếu chưa đăng nhập -->
                        <li class="header-cart-item flex-w flex-t m-b-12 text-center w-full">
                            <div class="header-cart-item-txt p-t-8 w-full">
                                <i class="zmdi zmdi-shopping-cart-off fs-50 cl1"></i>
                                <p class="mtext-103 cl2 p-t-10">Giỏ hàng trống</p>
                                <p class="stext-110 cl2 p-t-5">
                                    Vui lòng <a href="{{ route('fr.login') }}"
                                        class="hov-cl1 trans-04 cl1 font-weight-bold">đăng nhập</a> để xem giỏ hàng.
                                </p>
                            </div>
                        </li>
                    @endif
                </ul>

                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        Tổng: <span id="cart-total">{{ number_format($cartTotal) }} VND</span>
                    </div>
                    <a href="{{ route('cart.detail') }}"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Xem chi tiết
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
