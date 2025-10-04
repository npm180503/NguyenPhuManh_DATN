@extends('frontend.layout')
@section('content')
    <style>
        /* ===== Bảng giỏ hàng gọn gàng ===== */
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

        /* ====== FIX NHÓM SỐ LƯỢNG: border/hover khớp tuyệt đối ====== */
        .wrap-num-product {
            display: inline-flex;
            align-items: center;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            transition: border-color .2s;
        }

        .wrap-num-product:hover {
            border-color: #c6a353
        }

        /* viền vàng khi hover cả nhóm */

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
            transition: all .2s ease;
            flex: 0 0 38px;
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
            color: #111;
        }

        .num-product:focus {
            outline: none
        }

        /* đường ngăn trong nhóm để không “lệch border” khi hover nút */
        .btn-num-product-down-cart {
            border-right: 1px solid #e5e7eb
        }

        .btn-num-product-up-cart {
            border-left: 1px solid #e5e7eb
        }

        /* ===== Nút xóa ===== */
        .btn-remove-cart {
            background: transparent;
            border: none;
            color: #b91c1c;
            margin-left: 6px;
            font-size: 16px;
            transition: .25s
        }

        .btn-remove-cart:hover {
            color: #991b1b;
            transform: scale(1.1)
        }

        /* ===== Hóa đơn / form ===== */
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
            transition: all .25s ease;
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


        /* Giữ tổng tiền + nút X trên CÙNG MỘT DÒNG và canh phải */
        .table-shopping-cart td.column-6 {
            text-align: right;
            white-space: nowrap;
            /* không cho xuống dòng */
            vertical-align: middle;
        }

        /* Tổng tiền cách nút X một chút */
        .table-shopping-cart td.column-6 .item-total {
            display: inline-block;
            margin-right: 10px;
        }

        /* Nút X tròn, luôn cân giữa, không bị lệch cao */
        .btn-remove-cart {
            display: inline-grid;
            /* giữ icon ở giữa */
            place-items: center;
            width: 28px;
            height: 28px;
            line-height: 1;
            /* tránh kéo cao dòng */
            border-radius: 50%;
            margin-left: 2px;
            /* nhẹ tay, không đẩy xuống */
            vertical-align: middle;
        }
    </style>

    <div class="container" style="margin-top:100px">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('fr.homepage') }}" class="stext-109 cl8 hov-cl1 trans-04">Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">Giỏ hàng</span>
        </div>
    </div>

    <form class="bg0 p-t-75 p-b-85" action="{{ route('fr.order') }}" method="POST">
        @csrf
        <div class="container">
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
                            @if (!empty($cart->content()))
                                @foreach ($cart->content() as $key => $item)
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
                                                    data-price="{{ $item->product->price_sale }}">{{ number_format($item->product->price_sale) }}
                                                    VND</span>
                                            @else
                                                <span class="item-price"
                                                    data-price="{{ $item->product->price }}">{{ number_format($item->product->price) }}
                                                    VND</span>
                                            @endif
                                        </td>
                                        <td class="column-5 text-center">
                                            <!-- NHÓM – 1 + ĐÃ FIX BORDER/HOVER -->
                                            <div class="wrap-num-product">
                                                <div class="btn-num-product-down-cart cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>
                                                <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                    name="num-product1" data-item-id="{{ $key }}"
                                                    data-action="update" value="{{ $item->quantity }}" min="1">
                                                <div class="btn-num-product-up-cart cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-6 text-center">
                                            <span class="item-total"
                                                id="row-{{ $key }}">{{ number_format($item->total()) }}
                                                VND</span>
                                            <button class="btn-remove-cart" data-url="{{ route('cart.remove', $key) }}"
                                                data-rowid="{{ $item->id }}">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table_head">
                                    <th class="text-center" colspan="6">Bạn chưa có sản phẩm nào trong giỏ hàng</th>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <!-- Hóa đơn -->
                <div class="col-lg-4 col-xl-4">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">Hóa đơn</h4>
                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208"><span class="stext-110 cl2">Tổng:</span></div>
                            <div class="size-209" id="total-amount"><span
                                    class="mtext-110 cl2">{{ number_format($cart->rawTotal()) }} VND</span></div>
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

                        <button class="checkout-btn">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            var processing = false;
            $('.btn-num-product-up-cart, .btn-num-product-down-cart').off('click').on('click', function(e) {
                e.preventDefault(); // Ngăn chặn sự kiện chạy 2 lần nếu form có submit
                if (processing == true) return;
                processing = true;

                let row = $(this).closest('tr');
                let input = row.find('.num-product');
                let newValue = parseInt(input.val()) + ($(this).hasClass('btn-num-product-up-cart') ? 1 : -
                    1);
                newValue = Math.max(1, newValue);
                let itemId = input.data('item-id');
                let url = "{{ url('cart/update') }}/" + itemId;

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        quantity: newValue,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        $(`#row-${itemId}`).html(res.amount);
                        $('#total-amount span').text(res.total_amount);
                        input.val(newValue);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: xhr.responseJSON?.message ??
                                'Không thể cập nhật số lượng sản phẩm.',
                        });
                    },
                }).always(function() {
                    processing = false;
                });
            });
        });

        $(document).ready(function() {
            $(document).on("focusin", ".num-product", function() {
                $(this).data("old-value", $(this).val());
            });

            $(document).on("change", ".num-product", function() {
                let input = $(this);
                let oldValue = parseInt(input.data("old-value")) || 1; // giá trị cũ
                let newValue = parseInt(input.val());
                if (isNaN(newValue) || newValue < 1) {
                    newValue = 1;
                }

                let itemId = input.data("item-id");
                let url = "{{ url('cart/update') }}/" + itemId;

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        quantity: newValue,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        $(`#row-${itemId}`).html(res.amount);
                        $("#total-amount span").text(res.total_amount);
                        input.val(newValue);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: xhr.responseJSON?.message ??
                                'Không thể cập nhật số lượng sản phẩm.',
                        });
                        input.val(oldValue);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Xử lý xóa sản phẩm khỏi giỏ hàng
            $(document).on("click", ".btn-remove-cart", function() {
                let button = $(this);
                let rowId = button.data("rowid");
                let productId = button.data("id");
                let url = button.data("url").replace(':id', productId);

                // Hiển thị hộp thoại xác nhận
                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Sản phẩm này sẽ bị xóa khỏi giỏ hàng!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Có, xóa ngay!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                rowId: rowId,
                                _method: "DELETE",
                            },
                            success: function(response) {
                                if (response.success) {
                                    $(".cart-content").html(response.html);
                                    Swal.fire({
                                        title: "Đã xóa!",
                                        text: "Sản phẩm đã được xóa khỏi giỏ hàng.",
                                        icon: "success"
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: "Không thể xóa sản phẩm.",
                                        icon: "error"
                                    });
                                }
                                location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    title: "Lỗi!",
                                    text: "Có lỗi xảy ra, vui lòng thử lại.",
                                    icon: "error"
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".checkout-btn").addEventListener("click", function(e) {
                e.preventDefault(); // Ngăn form submit mặc định

                let name = document.querySelector("input[name='name']").value.trim();
                let phone = document.querySelector("input[name='phone']").value.trim();
                let address = document.querySelector("input[name='address']").value.trim();
                let cartCount =
                    {{ count($cart->content()) }}; // Truyền số lượng sản phẩm từ Laravel vào JS

                if (!name || !phone || !address) {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi!",
                        text: "Vui lòng nhập đầy đủ họ tên, số điện thoại và địa chỉ giao hàng.",
                    });
                    return;
                }

                if (cartCount == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi!",
                        text: "Giỏ hàng của bạn đang trống.",
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
                    success: function(response) {
                        if (response.payment_method === "Momo") {
                            // Nếu chọn momo thì chuyển hướng đến route xử lý momo
                            window.location.href = "{{ route('fr.momo.payment') }}?order_id=" +
                                response.order_id;
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Bạn đã đặt hàng thành công',
                                text: 'Cảm ơn bạn.',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed || result.dismiss === Swal
                                    .DismissReason.timer) {
                                    window.location.href =
                                        `/order/detail/${response.order_id}`;
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        alert('Lỗi: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endsection
