@extends('frontend.layout')
@section('content')
    <style>
        .how-active1 {
            font-weight: bold;
            color: red !important;
            border-bottom: 2px solid red;
        }

        .active-filter {
            font-weight: bold;
            color: red !important;
        }


        .hidden {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: opacity 0.5s ease, max-height 0.5s ease;
        }

        .visible {
            margin-bottom: 50px;
            opacity: 1;
            max-height: 400px;
            /* Đảm bảo chiều cao tối đa lớn hơn chiều cao sản phẩm */
            transition: opacity 0.5s ease, max-height 0.5s ease;
        }

        .product-price {
            font-size: 18px;
            margin-top: 10px;
        }

        .original-price {
            text-decoration: line-through;
            color: gray;
            margin-right: 10px;
        }

        .sale-price {
            color: red;
            font-weight: bold;
        }

        .current-price {
            font-weight: bold;
        }
        .submenu {
    margin-top: 8px;
    margin-left: 20px;
}
.submenu.hidden {
    display: none;
}

    </style>
    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140" style="margin-top:30px">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1 filter-btn" data-filter="all">
                        Tất cả
                    </button>
                    @foreach ($menus as $menu)
                        <div class="menu-group" style="display:inline-block;">
                            <!-- Nút danh mục cha -->
                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 parent-btn"
                                data-filter="{{ $menu->id }}">
                                {{ $menu->name }}
                            </button>

                            <!-- Danh mục con, ẩn mặc định -->
                            @if ($menu->children->count())
                                <div class="submenu hidden" id="submenu-{{ $menu->id }}">
                                    @foreach ($menu->children as $child)
                                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-16 m-tb-5 filter-btn child-btn"
                                            data-filter="{{ $child->id }}">
                                            └ {{ $child->name }}
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 filter-btn" data-filter="sale">
                        Giảm giá
                    </button>
                </div>


                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filter
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" id="search-input" type="text"
                            name="search-product" placeholder="Search">
                    </div>
                </div>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Sắp xếp
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04" data-sort="default">
                                        Mặc định
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04" data-sort="newest">
                                        Mới nhất
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04" data-sort="price-low">
                                        Giá: Thấp đến cao
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04" data-sort="price-high">
                                        Giá: Cao đến thấp
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Giá
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04" data-price="all">
                                        Tất cả
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04" data-price="0-499000">
                                        Dưới 500.000 VND
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04" data-price="500000-999000">
                                        500.000 - 999.000 VND
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04" data-price="1000000-2999000">
                                        1.000.000 - 2.999.000 VND
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04" data-price="3000000+">
                                        Trên 3.000.000 VND
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="product-list">
                @include('frontend.product.list', ['products' => $products])
            </div>
        </div>
    </div>


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
    <script src="{{ asset('template/js/main.js') }}?v={{ time() }}"></script>

    <script src={{ asset('template/js/product.js?v=' . time()) }}></script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const filterButtons = document.querySelectorAll(".filter-tope-group button");
            const searchInput = document.querySelector("#search-input");
            const sortFilters = document.querySelectorAll("[data-sort]");
            const priceFilters = document.querySelectorAll("[data-price]");

            function fetchProducts() {
                let menuId = document.querySelector(".filter-tope-group .how-active1")?.getAttribute(
                    "data-filter") || "all";
                let filter = document.querySelector(".filter-active")?.getAttribute("data-sort") || "";
                let priceRange = document.querySelector(".price-active")?.getAttribute("data-price") ||
                    "all"; // Lấy giá trị lọc theo giá
                let search = searchInput.value.trim();

                $.ajax({
                    url: '{{ route('fr.product.filter') }}',
                    method: 'GET',
                    data: {
                        menu_id: menuId,
                        filter: filter,
                        price_range: priceRange,
                        search: search
                    }, // Gửi thêm price_range
                    success: function(response) {
                        $('#product-list').html(response.html);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Click vào danh mục
            filterButtons.forEach(button => {
                button.addEventListener("click", function() {
                    filterButtons.forEach(btn => btn.classList.remove("how-active1"));
                    this.classList.add("how-active1");
                    fetchProducts();
                });
            });

            // Click vào filter (sắp xếp)
            sortFilters.forEach(button => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    document.querySelectorAll("[data-sort]").forEach((el) => el.classList.remove(
                        "active-filter"));

                    // Thêm lớp active cho nút được chọn
                    this.classList.add("active-filter");
                    sortFilters.forEach(btn => btn.classList.remove("filter-active"));
                    this.classList.add("filter-active");
                    fetchProducts();
                });
            });

            // Click vào filter giá
            priceFilters.forEach(button => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    // Loại bỏ lớp active khỏi tất cả các nút lọc giá
                    document.querySelectorAll("[data-price]").forEach((el) => el.classList.remove(
                        "active-filter"));

                    // Thêm lớp active cho nút được chọn
                    this.classList.add("active-filter");
                    priceFilters.forEach(btn => btn.classList.remove("price-active"));
                    this.classList.add("price-active");
                    fetchProducts();
                });
            });

            // Nhập tìm kiếm
            searchInput.addEventListener("keyup", function() {
                fetchProducts();
            });
        });
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const parentButtons = document.querySelectorAll(".parent-btn");

    parentButtons.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();

            // Tìm submenu của cha này
            const submenu = document.querySelector("#submenu-" + this.dataset.filter);

            // Ẩn các submenu khác
            document.querySelectorAll(".submenu").forEach(sm => {
                if (sm !== submenu) sm.classList.add("hidden");
            });

            // Toggle submenu hiện tại
            if (submenu) submenu.classList.toggle("hidden");

            // Vẫn gọi filter product như cũ
            fetchProducts();
        });
    });
});

    </script>
@endsection
