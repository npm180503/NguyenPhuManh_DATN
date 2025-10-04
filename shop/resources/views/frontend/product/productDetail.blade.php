@extends('frontend.layout')
@section('content')
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

        .content-wrapper {
            position: relative;
            max-height: 100px;
            /* ban đầu chỉ hiển thị 20px */
            overflow: hidden;
        }

        .content-wrapper.expanded {
            max-height: 1000px;
            /* khi mở rộng */
            transition: max-height 0.5s ease;
        }

        .content-text {
            margin: 0;
            line-height: 1.5;
        }

        .show-more-overlay {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.9) 70%);
            cursor: pointer;
            padding-top: 5px;
        }

        .show-more-overlay .btn-show-more {
            color: #ff6600;
            font-weight: bold;
            font-size: 14px;
        }

        .show-more-overlay .arrow-down {
            display: block;
            margin: 2px auto 0;
            font-size: 12px;
            color: #ff6600;
            animation: bounce 1s infinite;
        }

        /* Hiệu ứng mũi tên nhấp nháy */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(3px);
            }
        }

        .related-products {
            padding-left: 40px;
            padding-right: 40px;
        }

        .related-products .related-img {
            height: 200px;
            /* chiều cao ảnh đồng bộ */
            object-fit: cover;
            /* cắt ảnh vừa khung, không méo */
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .related-products .related-img:hover {
            transform: scale(1.05);
        }

        .related-products .card {
            border-radius: 12px;
            overflow: hidden;
        }
    </style>
    <div class="container" style="margin-top:100px">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <!-- Link Trang chủ -->
            <a href="{{ route('fr.product') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <!-- Nếu có danh mục cha cấp cao nhất -->
            @if ($rootCategory)
                <a href="{{ route('fr.product', ['menu_id' => $rootCategory->id]) }}" class="stext-109 cl8 hov-cl1 trans-04">
                    {{ $rootCategory->name }}
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>
            @endif

            <!-- Nếu có danh mục cha -->
            @if ($parentCategory)
                <a href="{{ route('fr.product', ['menu_id' => $parentCategory->id]) }}"
                    class="stext-109 cl8 hov-cl1 trans-04">
                    {{ $parentCategory->name }}
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>
            @endif

            <!-- Hiển thị danh mục sản phẩm -->
            <a href="{{ route('fr.product', ['menu_id' => $category->id]) }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $category->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <!-- Hiển thị tên sản phẩm -->
            <span class="stext-109 cl4">
                {{ $product->name }}
            </span>
        </div>
    </div>




    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="product-gallery d-flex">
                            <!-- Thumbnail dọc bên trái -->
                            <div class="thumbs-wrapper-vertical">
                                <button type="button" class="slick-prev-vertical"><i class="fa fa-chevron-up"></i></button>
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
                                <button type="button" class="slick-prev-main"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" class="slick-next-main"><i class="fa fa-chevron-right"></i></button>
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

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#content" role="tab">Mô tả</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#description" role="tab">Thông tin sản phẩm</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Đánh giá (
                                {{ $reviewCount }} )</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="content" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md content-wrapper">
                                <p class="stext-102 cl6 content-text">
                                    {!! $product->content !!}
                                </p>
                                <div class="show-more-overlay">
                                    <span class="btn-show-more">Xem thêm</span>
                                    <i class="fa fa-chevron-down arrow-down"></i>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>
                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        @php
                                            $user = auth('frontend')->user();
                                        @endphp
                                        @if ($product->reviews && $product->reviews->count())
                                            @foreach ($product->reviews as $review)
                                                <div class="flex-w flex-t p-b-68">
                                                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                        <img src="{{ asset($user->thumb) }}" alt="AVATAR">
                                                    </div>
                                                    <div class="size-207">
                                                        <div class="flex-w flex-sb-m p-b-17">
                                                            <span class="mtext-107 cl2 p-r-20">
                                                                {{ $review->user->name }}
                                                            </span>
                                                            <span class="fs-18 cl11">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i
                                                                        class="zmdi {{ $i <= $review->rating ? 'zmdi-star' : 'zmdi-star-outline' }}"></i>
                                                                @endfor
                                                            </span>
                                                        </div>
                                                        <p class="stext-102 cl6">
                                                            {{ $review->comment }}
                                                        </p>

                                                        @if ($review->images)
                                                            <div class="review-images">
                                                                @foreach ($review->images as $image)
                                                                    <img src="{{ asset($image->path) }}"
                                                                        alt="review image"
                                                                        style="max-width: 120px; border-radius: 6px; margin-top: 5px;">
                                                                @endforeach


                                                            </div>
                                                        @endif

                                                        <!-- Kiểm tra nếu có phản hồi từ admin -->
                                                        @if ($review->admin_reply)
                                                            <div class="admin-reply mt-4">
                                                                <strong>Phản hồi từ Admin:</strong>
                                                                <p class="stext-102 cl6"
                                                                    style="margin-left: 20px; font-style: italic; color: #007bff;">
                                                                    {{ $review->admin_reply }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                                        @endif


                                        <!-- Add review -->
                                        <form class="w-full" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="flex-w flex-m p-t-50 p-b-23">
                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>

                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>

                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>

                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>

                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <input class="dis-none" type="hidden" name="rating"
                                                        value="">

                                                </span>
                                            </div>



                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">Đánh giá của bạn</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                                </div>
                                            </div>
                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3">Ảnh</label>
                                                    <input type="file" name="image" multiple accept="image/*"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <button
                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Gửi
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                Mã: Pmou-{{ $product->id }}
            </span>

            <span class="stext-107 cl6 p-lr-25">
                Loại:
                @if ($rootCategory)
                    {{ $rootCategory->name }},
                @endif
                @if ($parentCategory)
                    {{ $parentCategory->name }},
                @endif
                {{ $category->name }}
            </span>

        </div>

        <div class="related-products mt-5 container">
            <h3 class="text-center mb-4">Sản phẩm liên quan</h3>
            <div class="row">
                @foreach ($relatedProducts as $product)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100 text-center border-0 shadow-sm">
                            <a href="{{ route('fr.product.detail', $product->id) }}">
                                <img src="{{ asset($product->thumb) }}" class="card-img-top related-img"
                                    alt="{{ $product->name }}">
                            </a>
                            <div class="card-body">
                                <a href="{{ route('fr.product.detail', ['productID' => $product->id]) }} ">
                                    {{ $product->name }}
                                </a>

                                @if ($product->price_sale && $product->price_sale < $product->price)
                                    <p class="mb-0">
                                        <span class="text-danger fw-bold">
                                            {{ number_format($product->price_sale, 0, ',', '.') }} VND
                                        </span>
                                        <br>
                                        <small class="text-muted" style="text-decoration: line-through;">
                                            {{ number_format($product->price, 0, ',', '.') }} VND
                                        </small>
                                    </p>
                                @else
                                    <p class="text-danger fw-bold mb-0">
                                        {{ number_format($product->price, 0, ',', '.') }} VND
                                    </p>
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>



    </section>

    <script>
        $('form').submit(function(e) {
            e.preventDefault();

            var isAuthenticated = {{ auth('frontend')->check() ? 'true' : 'false' }};
            if (!isAuthenticated) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Bạn chưa đăng nhập',
                    text: 'Vui lòng đăng nhập để thực hiện đánh giá.',
                    confirmButtonText: 'Đăng nhập',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('fr.login') }}";
                    }
                });
                return;
            }

            var rating = $('input[name="rating"]').val();
            if (!rating || rating < 1 || rating > 5) {
                alert("Vui lòng chọn đánh giá hợp lệ (1-5 sao).");
                return;
            }

            let formData = new FormData(this); // lấy toàn bộ form gồm cả file

            $.ajax({
                url: "{{ route('fr.review.send') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đánh giá của bạn đã được gửi!',
                        text: 'Cảm ơn bạn đã để lại đánh giá.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    alert('Lỗi: ' + xhr.responseJSON.message);
                }
            });
        });
    </script>

    {{-- <script src="{{ asset('js/public.js') }}"></script> --}}

    <script src={{ asset('template/js/product.js?v=' . time()) }}></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sizeButtons = document.querySelectorAll('.size-button');

            sizeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Kiểm tra nếu button bị disabled thì không làm gì cả
                    if (this.classList.contains('disabled')) {
                        return;
                    }

                    // Bỏ class "active" khỏi tất cả các button
                    sizeButtons.forEach(btn => btn.classList.remove('active'));

                    // Thêm class "active" vào button được bấm
                    this.classList.add('active');

                    // Lấy giá trị size đã chọn
                    const selectedSize = this.getAttribute('data-size');
                    console.log("Size đã chọn:", selectedSize);
                });
            });
        });
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
    <script>
        $(document).ready(function() {
            $('.show-more-overlay').on('click', function() {
                var $wrapper = $(this).closest('.content-wrapper');
                $wrapper.toggleClass('expanded');

                // Ẩn overlay khi mở rộng
                if ($wrapper.hasClass('expanded')) {
                    $(this).fadeOut();
                } else {
                    $(this).fadeIn();
                }
            });
        });
    </script>
@endsection
