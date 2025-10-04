@extends('frontend.layout')
@section('content')
    <style>
        /* Bảng / layout chung */
        .wrap-table-shopping-cart {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .05);
            overflow: hidden;
            padding: 20px
        }

        .table-shopping-cart {
            width: 100%;
            border-collapse: collapse
        }

        .table-shopping-cart th {
            background: #f9fafb;
            color: #444;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: .5px
        }

        .table-shopping-cart th,
        .table-shopping-cart td {
            padding: 14px 12px;
            border-bottom: 1px solid #eee;
            vertical-align: middle
        }

        .table-shopping-cart tr:hover {
            background: #fffef8;
            transition: .25s
        }

        .column-1 {
            width: 15%
        }

        .column-2 {
            width: 30%
        }

        .column-3,
        .column-4,
        .column-5,
        .column-6 {
            width: 15%;
            text-align: center
        }

        .how-itemcart1 {
            width: 90px;
            height: 90px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #eee
        }

        .how-itemcart1 img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        /* Nhóm số lượng – khớp border */
        .wrap-num-product {
            display: inline-flex;
            align-items: center;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            transition: border-color .2s
        }

        .wrap-num-product:hover {
            border-color: #c6a353
        }

        .btn-num-product-down-cart,
        .btn-num-product-up-cart {
            background: #f9fafb;
            border: none;
            color: #444;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: 600;
            transition: .2s;
            flex: 0 0 38px
        }

        .btn-num-product-down-cart:hover,
        .btn-num-product-up-cart:hover {
            background: #c6a353;
            color: #fff
        }

        .num-product {
            width: 54px;
            height: 38px;
            border: none;
            background: transparent;
            text-align: center;
            font-weight: 600;
            font-size: 15px;
            color: #111
        }

        .num-product:focus {
            outline: none
        }

        .btn-num-product-down-cart {
            border-right: 1px solid #e5e7eb
        }

        .btn-num-product-up-cart {
            border-left: 1px solid #e5e7eb
        }

        /* Tổng tiền + nút xoá cùng dòng, không xuống hàng */
        .table-shopping-cart td.column-6 {
            text-align: right;
            white-space: nowrap;
            vertical-align: middle
        }

        .table-shopping-cart td.column-6 .item-total {
            display: inline-block;
            margin-right: 10px
        }

        .btn-remove-cart {
            display: inline-grid;
            place-items: center;
            width: 28px;
            height: 28px;
            line-height: 1;
            border-radius: 50%;
            background: transparent;
            border: none;
            color: #b91c1c;
            margin-left: 2px;
            transition: .25s;
            vertical-align: middle
        }

        .btn-remove-cart:hover {
            color: #991b1b;
            transform: scale(1.1)
        }

        /* Panel hoá đơn / form */
        .bor10 {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 10px 32px rgba(0, 0, 0, .08);
            border: 1px solid #f2f2f2
        }

        .mtext-109 {
            font-weight: 800;
            font-size: 22px;
            color: #111
        }

        .checkout-input input,
        .checkout-select select {
            width: 100%;
            padding: 12px 14px;
            margin-top: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            background: #fff;
            color: #111;
            transition: .25s;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .04)
        }

        .checkout-input input:hover,
        .checkout-select select:hover {
            border-color: #d4af37
        }

        .checkout-input input:focus,
        .checkout-select select:focus {
            outline: none;
            border-color: #c6a353;
            box-shadow: 0 0 0 3px rgba(198, 163, 83, .2)
        }

        .checkout-select select {
            appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, #c6a353 50%), linear-gradient(135deg, #c6a353 50%, transparent 50%);
            background-position: calc(100% - 20px) calc(1.2em + 2px), calc(100% - 15px) calc(1.2em + 2px);
            background-size: 6px 6px, 6px 6px;
            background-repeat: no-repeat
        }

        .checkout-btn {
            width: 100%;
            padding: 14px;
            margin-top: 24px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #d4af37, #c6a353, #a9852e);
            color: #111;
            font-weight: 800;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: .4px;
            box-shadow: 0 8px 22px rgba(198, 163, 83, .28);
            transition: .25s
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(198, 163, 83, .35)
        }

        /* EMPTY STATE */
        .empty-wrap {
            padding: 28px
        }

        .empty-card {
            max-width: 920px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid rgba(2, 6, 23, .06);
            border-radius: 18px;
            box-shadow: 0 10px 28px rgba(2, 6, 23, .06);
            text-align: center;
            padding: 36px 22px
        }

        .empty-hero {
            display: grid;
            place-items: center;
            margin-bottom: 12px
        }

        .empty-sub {
            color: #6b7280
        }

        .btns-empty {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 14px
        }

        .btn-gold,
        .btn-ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: .85rem 1.15rem;
            border-radius: 12px;
            font-weight: 800;
            letter-spacing: .4px
        }

        .btn-gold {
            border: none;
            color: #111;
            background: linear-gradient(135deg, #d4af37, #c6a353, #a9852e);
            box-shadow: 0 8px 22px rgba(198, 163, 83, .28);
            transition: .25s
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(198, 163, 83, .35)
        }

        .btn-ghost {
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #111
        }

        .btn-ghost:hover {
            border-color: #c6a353
        }
    </style>

    <!-- breadcrumb -->
    <div class="container" style="margin-top:100px">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('fr.homepage') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">Giỏ hàng</span>
        </div>
    </div>

    <form class="bg0 p-t-75 p-b-85" action="{{ route('fr.order') }}" method="POST">
        @csrf
        <div class="container">

            @if (count($cartItems) === 0)
                {{-- ===== EMPTY STATE ===== --}}
                <div class="row">
                    <div class="col-12">
                        <div class="empty-wrap">
                            <div class="empty-card">
                                <div class="empty-hero">
                                    <svg width="88" height="88" viewBox="0 0 24 24" fill="none"
                                        aria-hidden="true">
                                        <path
                                            d="M4 15c2 0 3.5-1 5-3l2 2c1 1 2 1 4 1h3a2 2 0 0 1 2 2v1H3a2 2 0 0 1-2-2v-1h3Z"
                                            stroke="url(#g1)" stroke-width="1.6" />
                                        <path d="M9 10c.7.9 1.3 1.5 2 2" stroke="#94a3b8" stroke-width="1.6"
                                            stroke-linecap="round" />
                                        <circle cx="6" cy="17" r="1.6" fill="#cbd5e1" />
                                        <circle cx="18" cy="17" r="1.6" fill="#cbd5e1" />
                                        <defs>
                                            <linearGradient id="g1" x1="0" x2="24" y1="0"
                                                y2="24" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#d4af37" />
                                                <stop offset="1" stop-color="#a9852e" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                <h4 class="mb-2">Giỏ hàng của bạn đang trống</h4>
                                <div class="empty-sub mb-2">Khám phá bộ sưu tập mới — món đầu tiên sẽ xuất hiện ở đây ✨
                                </div>
                                <div class="btns-empty">
                                    <a href="{{ route('fr.product') }}" class="btn-gold"><i class="fas fa-shopping-bag"></i>
                                        Tiếp tục mua sắm</a>
                                    <a href="{{ route('fr.homepage') }}" class="btn-ghost"><i class="fas fa-home"></i> Về
                                        trang chủ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- ===== CÓ SẢN PHẨM ===== --}}
                <div class="row">
                    <!-- Bảng sản phẩm -->
                    <div class="col-lg-8 col-xl-8 m-b-50">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1 text-left">SẢN PHẨM</th>
                                    <th class="column-2"></th>
                                    <th class="column-3 text-center">SIZE</th>
                                    <th class="column-4 text-center">GIÁ</th>
                                    <th class="column-5 text-center">SỐ LƯỢNG</th>
                                    <th class="column-6 text-center">THÀNH TIỀN</th>
                                </tr>
                                @foreach ($cartItems as $key => $item)
                                    <tr class="table_row">
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="{{ $item->product->thumb }}" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2">{{ $item->product->name }}</td>
                                        <td class="column-3 text-center">{{ $item->size->name }}</td>
                                        <td class="column-4 text-center">
                                            @if ($item->product->price_sale && $item->product->price_sale < $item->product->price)
                                                <span class="item-price text-danger"
                                                    data-price="{{ $item->product->price_sale }}">
                                                    {{ number_format($item->product->price_sale) }} VND
                                                </span>
                                            @else
                                                <span class="item-price" data-price="{{ $item->product->price }}">
                                                    {{ number_format($item->product->price) }} VND
                                                </span>
                                            @endif
                                        </td>
                                        <td class="column-5 text-center">
                                            <div class="wrap-num-product">
                                                <div class="btn-num-product-down-cart cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>
                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                    name="num-product1" data-item-id="{{ $item->product->id }}"
                                                    data-action="update" value="{{ $item->quantity }}" min="1">
                                                <div class="btn-num-product-up-cart cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-6 text-center">
                                            <span class="item-total" id="row-{{ $item->product_id }}">
                                                {{ number_format(($item->product->price_sale ?? $item->product->price) * $item->quantity) }}
                                                VND
                                            </span>
                                            <button class="btn-remove-cart"
                                                data-url="{{ route('cart.remove', $item->id) }}"
                                                data-rowid="{{ $item->id }}">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <!-- Hóa đơn -->
                    <div class="col-lg-4 col-xl-4">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">Hóa đơn</h4>
                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208"><span class="stext-110 cl2">Tổng:</span></div>
                                <div class="size-209" id="total-amount">
                                    <span class="mtext-110 cl2">{{ number_format($cartTotal) }} VND</span>
                                </div>
                            </div>

                            <div class="p-t-20">
                                <span class="stext-110 cl2">Thông tin giao hàng:</span>
                                <div class="checkout-input"><input type="text" id="name" name="name"
                                        placeholder="Họ và tên" required></div>
                                <div class="checkout-input"><input type="text" id="phone" name="phone"
                                        placeholder="Số điện thoại" required></div>
                                <div class="checkout-input"><input type="text" id="address" name="address"
                                        placeholder="Địa chỉ giao hàng" required></div>
                                <div class="checkout-input"><input type="text" id="email" name="email"
                                        placeholder="Email" required></div>
                            </div>

                            <div class="p-t-15">
                                <span class="stext-112 cl2">Chọn hình thức thanh toán:</span>
                                <div class="checkout-select">
                                    <select name="payment_method">
                                        <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                        <option value="momo">Thanh toán qua MoMo</option>
                                    </select>
                                </div>
                            </div>

                            <button class="checkout-btn">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </form>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top"><i class="zmdi zmdi-chevron-up"></i></span>
    </div>

    {{-- JS: chỉ gắn khi có sản phẩm --}}
    @if (count($cartItems) > 0)
        <script>
            $(function() {
                let processing = false;

                $('.btn-num-product-up-cart, .btn-num-product-down-cart').on('click', function(e) {
                    e.preventDefault();
                    if (processing) return;
                    processing = true;

                    const row = $(this).closest('tr');
                    const input = row.find('.num-product');
                    let newValue = parseInt(input.val()) + ($(this).hasClass('btn-num-product-up-cart') ? 1 : -
                        1);
                    newValue = Math.max(1, newValue);
                    input.val(newValue);

                    const itemId = input.data('item-id');
                    $.ajax({
                        url: "{{ url('cart/update') }}/" + itemId,
                        method: "POST",
                        data: {
                            quantity: newValue,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            $("#row-" + itemId).html(res.amount);
                            $("#total-amount span").text(res.total_amount);
                        },
                        complete: function() {
                            processing = false;
                        }
                    });
                });

                $(document).on("change", ".num-product", function() {
                    let input = $(this);
                    let newValue = parseInt(input.val());
                    if (isNaN(newValue) || newValue < 1) {
                        newValue = 1;
                        input.val(newValue);
                    }
                    const itemId = input.data("item-id");
                    $.post("{{ url('cart/update') }}/" + itemId, {
                            quantity: newValue,
                            _token: "{{ csrf_token() }}"
                        },
                        function(res) {
                            $("#row-" + itemId).html(res.amount);
                            $("#total-amount span").text(res.total_amount);
                        }
                    );
                });


                document.querySelector(".checkout-btn").addEventListener("click", function(e) {
                    e.preventDefault();
                    let name = $("input[name='name']").val().trim(),
                        phone = $("input[name='phone']").val().trim(),
                        address = $("input[name='address']").val().trim();
                    if (!name || !phone || !address) {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi!",
                            text: "Vui lòng nhập đầy đủ họ tên, số điện thoại và địa chỉ giao hàng."
                        });
                        return;
                    }
                    $.ajax({
                        url: "{{ route('fr.order') }}",
                        method: "POST",
                        data: $('form').serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res) {
                            if (res.payment_method === "Momo") {
                                window.location.href = "{{ route('fr.momo.payment') }}?order_id=" +
                                    res.order_id;
                            } else {
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Bạn đã đặt hàng thành công',
                                        text: 'Cảm ơn bạn.'
                                    })
                                    .then(() => window.location.href = "/order/detail/" + res
                                        .order_id);
                            }
                        },
                        error: function(xhr) {
                            alert('Lỗi: ' + (xhr.responseJSON?.message || 'Không xác định'));
                        }
                    });
                });
            });
        </script>
    @endif
@endsection
