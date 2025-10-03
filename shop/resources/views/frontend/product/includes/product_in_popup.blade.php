<style>
    .size-button {
        padding: 10px 15px;
        border: 1px solid #ccc;
        background-color: white;
        cursor: pointer;
        margin-right: 10px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .size-button:hover {
        background-color: black;
        color: white;
    }

    .size-button.active {
        background-color: black !important;
        color: white !important;
        border-color: black !important;
    }



    .size-button.disabled {
        opacity: 0.5;
        pointer-events: none;
        cursor: not-allowed;
    }


    .wrap-modal1 {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.3s ease forwards;
    }

    .wrap-modal1.show-modal {
        display: flex;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .wrap-pic-w img {
        width: 100%;
        height: auto;
        object-fit: cover;
        max-height: 400px;
    }


    .product-gallery {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        max-width: 700px;
        margin: auto;
    }

    /* Vùng chứa ảnh chính */
    .main-wrapper {
        flex: 1;
        max-width: 500px;
        /* giới hạn chiều rộng */
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .slick-main {
        width: 100%;
    }

    .slick-main img {
        width: 100%;
        height: auto;
        /* giữ tỉ lệ thật */
        max-height: 500px;
        /* không vượt quá 500px */
        object-fit: contain;
        border-radius: 10px;
    }




    /* Nút trên ảnh chính */
    .slick-prev-main,
    .slick-next-main {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.8);
        border: none;
        font-size: 22px;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 50%;
        z-index: 10;
        color: #333;
    }

    .slick-prev-main {
        left: 10px;
    }

    .slick-next-main {
        right: 10px;
    }

    /* Thumbnail dọc */
    .thumbs-wrapper-vertical {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 110px;
        max-height: 500px;
        /* chiều cao cố định bằng ảnh chính */
    }

    .slick-thumbs-vertical {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .slick-thumbs-vertical div {
        margin: 5px 0;
    }

    .slick-thumbs-vertical img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        margin: 5px 0;
        border-radius: 8px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    /* Highlight thumbnail */
    .slick-thumbs-vertical div.slick-current img {
        border: 3px solid #ff6600;
        box-shadow: 0 0 10px #ff6600;
        transform: scale(1.05);
    }

    /* Fade mờ phần cuối */
    .thumbs-wrapper-vertical::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 45px;
        /* mờ nửa ảnh thứ 5 */
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.7));
        pointer-events: none;
    }



    /* Nút prev/next cho thumbnail */
    .slick-prev-vertical,
    .slick-next-vertical {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        cursor: pointer;
        border-radius: 50%;
        padding: 5px;
        font-size: 18px;
        margin: 5px 0;
    }
</style>


<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal1"></div>
    <div class="container">
        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                <img src="template/images/icons/icon-close.png" alt="CLOSE">
            </button>

            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="product-gallery d-flex">
                            <!-- Thumbnail dọc bên trái -->
                            <div class="thumbs-wrapper-vertical">
                                <button type="button" class="slick-prev-vertical"><i
                                        class="fa fa-chevron-up"></i></button>
                                <div class="slick-thumbs-vertical">
                                    <div>
                                        <img src="{{ asset($product->thumb) }}" alt="{{ $product->name }}">
                                    </div>
                                    @foreach ($product->images as $img)
                                        <div>
                                            <img src="{{ asset($img->image_path) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="slick-next-vertical"><i
                                        class="fa fa-chevron-down"></i></button>
                            </div>


                            <!-- Ảnh chính -->
                            <div class="main-wrapper">
                                <div class="slick-main">
                                    <div>
                                        <img src="{{ asset($product->thumb) }}" alt="{{ $product->name }}">
                                    </div>
                                    @foreach ($product->images as $img)
                                        <div>
                                            <img src="{{ asset($img->image_path) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                                <!-- nút prev/next trên ảnh chính -->
                                <button type="button" class="slick-prev-main"><i
                                        class="fa fa-chevron-left"></i></button>
                                <button type="button" class="slick-next-main"><i
                                        class="fa fa-chevron-right"></i></button>
                            </div>
                        </div>






                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->name }}
                        </h4>

                        <span class="mtext-106 cl2 js-price-detail">
                            @if ($product->price_sale)
                                <span class="original-price"
                                    style="text-decoration: line-through; color: gray;">{{ number_format($product->price) }}
                                    VND</span>
                                <span class="sale-price"
                                    style="color: red; font-weight: bold;">{{ number_format($product->price_sale) }}
                                    VND</span>
                            @else
                                <span class="current-price">{{ number_format($product->price, 0) }} VND</span>
                            @endif
                        </span>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">Size</div>
                                <div class="size-204 respon6-next">
                                    <div class="flex-w">
                                        @foreach ($sizes as $size)
                                            <button type="button"
                                                class="size-button {{ in_array($size->id, $availableSizes) ? '' : 'disabled' }}"
                                                data-size="{{ $size->name }}" data-size-id="{{ $size->id }}"
                                                {{ in_array($size->id, $availableSizes) ? '' : 'disabled' }}>
                                                {{ $size->name }}
                                            </button>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">

                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">

                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" id="quantity-product"
                                            type="number" name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                        data-id="{{ $product->id }}">
                                        Thêm vào giỏ hàng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var sizeButtons = document.querySelectorAll(".size-button:not(.disabled)");
    sizeButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định (nếu có)
            // Loại bỏ class active khỏi tất cả nút size
            sizeButtons.forEach(btn => btn.classList.remove("active"));
            // Thêm class active cho nút được click
            this.classList.add("active");
        });
    });
</script>
{{-- <script src="{{ asset('js/product.js') }}"></script> <!-- hoặc đường dẫn đến file JS của bạn --> --}}
<script>
    // $(document).on("click", ".js-addcart-detail", function(e) {
    //     e.preventDefault();

    //     var isAuthenticated = {{ auth('frontend')->check() ? 'true' : 'false' }};

    //     if (!isAuthenticated) {
    //         Swal.fire({
    //             icon: 'warning',
    //             title: 'Bạn chưa đăng nhập',
    //             text: 'Vui lòng đăng nhập để thêm vào giỏ hàng.',
    //             confirmButtonText: 'Đăng nhập',
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 window.location.href = "{{ route('fr.login') }}";
    //             }
    //         });
    //         return;
    //     }

    //     var productId = $(this).data("id");
    //     var quantity = $("#quantity-product").val();
    //     var selectedSize = $(".size-button.active").data("size-id");

    //     if (!selectedSize) {
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Chưa chọn size',
    //             text: 'Vui lòng chọn size trước khi thêm vào giỏ hàng'
    //         });
    //         return;
    //     }

    //     $.ajax({
    //         url: "{{ route('cart.add', ':id') }}".replace(':id', productId),
    //         method: "POST",
    //         data: {
    //             _token: "{{ csrf_token() }}",
    //             quantity: quantity,
    //             size_id: selectedSize
    //         },
    //         success: function(response) {
    //             // Load lại nội dung mini cart
    //             $.ajax({
    //                 url: "{{ route('cart.component') }}",
    //                 method: "GET",
    //                 success: function(html) {
    //                     $(".header-cart-content").html(html);
    //                     $(".js-show-cart").trigger("click");
    //                 }
    //             });

    //             // Nếu muốn thêm thông báo nhỏ
    //             Swal.fire({
    //                 toast: true,
    //                 position: 'top-end',
    //                 icon: 'success',
    //                 title: response.message ?? 'Đã thêm vào giỏ hàng',
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             });
    //         },
    //         error: function(xhr) {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Lỗi',
    //                 text: xhr.responseJSON?.message ?? 'Không thể thêm vào giỏ hàng'
    //             });
    //         }
    //     });
    // });
</script>
<script>
    $(document).ready(function() {
        // Slick cho ảnh chính
        $('.slick-main').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: $('.slick-prev-main'),
            nextArrow: $('.slick-next-main'),
            fade: true,
            autoplay: true,
            autoplaySpeed: 3000,
            asNavFor: '.slick-thumbs-vertical'
        });

        // Slick cho thumbnail dạng vòng tròn
        $('.slick-thumbs-vertical').slick({
            slidesToShow: 4, // hiển thị 4 thumbnail
            slidesToScroll: 1,
            vertical: true,
            infinite: true, // vòng lặp
            focusOnSelect: true,
            arrows: true,
            prevArrow: $('.slick-prev-vertical'),
            nextArrow: $('.slick-next-vertical'),
            asNavFor: '.slick-main'
        });
    });
</script>
