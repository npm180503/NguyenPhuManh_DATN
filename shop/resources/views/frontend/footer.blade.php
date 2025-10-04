<!-- Footer -->
<!-- Footer -->
<footer class="bg3 p-t-50 p-b-20">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Danh Mục -->
            <div class="col-sm-6 col-lg-3 p-b-30">
                <h4 class="stext-301 cl0 p-b-20">Danh Mục</h4>
                <ul>
                    @foreach ($menus as $menu)
                        <li class="p-b-5">
                            <a href="#" class="stext-104 cl7 hov-cl1 trans-04">{{ $menu->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Hỗ Trợ -->
            <div class="col-sm-6 col-lg-3 p-b-30">
                <h4 class="stext-301 cl0 p-b-20">Hỗ Trợ</h4>
                <ul>
                    <li class="p-b-5"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Track Order</a></li>
                    <li class="p-b-5"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Returns</a></li>
                    <li class="p-b-5"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">Shipping</a></li>
                    <li class="p-b-5"><a href="#" class="stext-107 cl7 hov-cl1 trans-04">FAQs</a></li>
                </ul>
            </div>

            <!-- Liên Hệ -->
            <div class="col-sm-6 col-lg-3 p-b-30">
                <h4 class="stext-301 cl0 p-b-20">Liên Hệ</h4>
                <p class="stext-104 cl7 size-201">
                    Mọi thắc mắc, xin vui lòng đến cửa hàng tại 201/45 Đ.Cầu Giấy hoặc qua hotline: 0123456789
                </p>
                <div class="p-t-15">
                    <a href="https://www.facebook.com/nguyen.manh.670379" class="fs-18 cl7 hov-cl1 trans-04 m-r-10"
                        target="_blank">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/_18flyn_/" class="fs-18 cl7 hov-cl1 trans-04 m-r-10"
                        target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Logo -->
            <div class="col-sm-6 col-lg-3 p-b-30 text-center">
                <a href="/" class="d-inline-block mb-3">
                    <img src="/template/admin/dist/img/download.jpg" alt="PMSTORE" style="height:60px;">
                </a>
                <p class="stext-104 cl7">
                    PMSTORE - Nơi mua sắm giày và thời trang chính hãng, uy tín hàng đầu Việt Nam.
                </p>
            </div>
        </div>

        <!-- Dòng bản quyền -->
        <div class="row mt-4 border-top pt-3">
            <div class="col-12 text-center">
                <p class="stext-107 cl7">© 2025 PMSTORE. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
<style>
    footer.bg3 {
        background-color: #222;
        /* nền đậm */
        color: #ccc;
        font-size: 14px;
    }

    footer h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #fff;
        text-transform: uppercase;
        position: relative;
        display: inline-block;
    }

    footer h4::after {
        content: "";
        display: block;
        width: 40px;
        height: 2px;
        background: #f44336;
        /* gạch đỏ dưới tiêu đề */
        margin-top: 8px;
    }

    footer ul {
        list-style: none;
        padding-left: 0;
    }

    footer ul li a {
        color: #bbb;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    footer ul li a:hover {
        color: #f44336;
        /* đổi màu khi hover */
        padding-left: 5px;
    }

    footer p {
        color: #aaa;
        line-height: 1.6;
    }

    footer .fa-brands {
        font-size: 20px;
        transition: 0.3s;
    }

    footer .fa-brands:hover {
        color: #f44336;
        transform: scale(1.2);
    }

    footer img {
        max-width: 100%;
        height: auto;
        transition: transform 0.3s;
    }

    footer img:hover {
        transform: scale(1.05);
    }

    footer .border-top {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    footer .stext-107 {
        font-size: 13px;
        color: #888;
    }
</style>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<!--===============================================================================================-->
<script src="/template/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="/template/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="/template/vendor/bootstrap/js/popper.js"></script>
<script src="/template/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="/template/vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function() {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<!--===============================================================================================-->
<script src="/template/vendor/daterangepicker/moment.min.js"></script>
<script src="/template/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="/template/vendor/slick/slick.min.js"></script>
<script src="/template/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="/template/vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="/template/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="/template/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="/template/vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('.js-addwish-b2').on('click', function(e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function() {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    // $('.js-addcart-detail').each(function(){
    //     var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
    //     $(this).on('click', function(){
    //         swal(nameProduct, "is added to cart !", "success");
    //     });
    // });
</script>
<!--===============================================================================================-->
<script src="/template/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        })
    });
</script>
<!--===============================================================================================-->
<script src="/template/js/main.js?v={{ time() }}"></script>
<script src="/template/js/product.js"></script>
