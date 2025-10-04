<style>
/* ===== Header & Menu ===== */
header {
    position: relative;
    z-index: 1000;
}

.main-menu li a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    padding: 10px 15px;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
}

.main-menu li a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0;
    height: 3px;
    background: linear-gradient(90deg, #ff6600, #ffcc00);
    border-radius: 3px;
    transition: width 0.3s ease;
}

.main-menu li a:hover::after,
.main-menu li.active a::after {
    width: 100%;
}

.main-menu li.active a {
    color: #ff6600;
    font-weight: bold;
}

/* ===== Notification ===== */
.notification-dropdown {
    position: absolute;
    top: 60px;
    right: 0;
    width: 360px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    display: none;
    overflow: hidden;
    animation: fadeIn 0.3s ease-in-out;
}

.notification-dropdown.active {
    display: block;
}

.notification-header {
    background: linear-gradient(135deg, #ff6600, #ff6347);
    color: #fff;
    padding: 15px;
    font-weight: bold;
    text-align: center;
    font-size: 16px;
}

.notification-dropdown ul {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 350px;
    overflow-y: auto;
}

.notification-dropdown li {
    padding: 15px;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: background 0.3s;
}

.notification-dropdown li:hover {
    background: #fffaf5;
}

.notification-icon {
    width: 40px;
    height: 40px;
    background: #ff6600;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 16px;
    flex-shrink: 0;
}

.notification-text {
    flex: 1;
    font-size: 14px;
}

.badge {
    padding: 5px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
    color: #fff;
}

.badge-pending { background-color: orange; }
.badge-processing { background-color: #3498db; }
.badge-shipped { background-color: purple; }
.badge-completed { background-color: green; }
.badge-canceled { background-color: red; }

.notification-dot {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 10px;
    height: 10px;
    background-color: red;
    border-radius: 50%;
    animation: pulse 1.2s infinite;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px);}
    to { opacity: 1; transform: translateY(0);}
}

@keyframes pulse {
    0% { transform: scale(0.8); opacity: 0.8;}
    50% { transform: scale(1.2); opacity: 1;}
    100% { transform: scale(0.8); opacity: 0.8;}
}

/* ===== Avatar dropdown ===== */
.dropdown img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    cursor: pointer;
    transition: transform 0.3s;
}

.dropdown img:hover {
    transform: scale(1.1);
}

.dropdown-menu {
    border-radius: 12px;
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}

.dropdown-menu a {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    padding: 10px 20px;
    transition: background 0.3s;
}

.dropdown-menu a:hover {
    background: #fffaf5;
}
</style>
<div>
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="{{ route('fr.homepage') }}" class="logo">
                        <img src="/template/admin/dist/img/download.jpg" alt="AdminLTE Logo"
                            class="brand-image img-circle elevation-3"
                            style="opacity: .8; width: 50px; height: 120px; border-radius: 50%;">
                        <span class="brand-text"
                            style="font-family: 'Lobster', cursive; font-size: 32px; color: #ff6347; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding-left: 10px; margin-top: 5px;">PMSTORE</span>
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="{{ request()->is('/') ? 'active' : '' }}">
                                <a href="{{ route('fr.homepage') }}">Trang chủ</a>
                            </li>


                            <li class="{{ request()->is('product') ? 'active' : '' }}">
                                <a href="{{ route('fr.product') }}">Cửa hàng</a>
                            </li>

                            <li class="{{ request()->is('new') ? 'active' : '' }}">
                                <a href="{{ route('fr.new') }}">Tin tức</a>
                            </li>

                            <li class="{{ request()->is('about') ? 'active' : '' }}">
                                <a href="{{ route('fr.about') }}">Giới thiệu</a>
                            </li>

                            <li class="{{ request()->is('contact') ? 'active' : '' }}">
                                <a href="{{ route('fr.contact') }}">Liên hệ</a>
                            </li>
                        </ul>
                    </div>

                    @php
                        $statusMessages = [];

                        // Danh sách trạng thái & thông báo tương ứng
                        $statusLabels = [
                            'pending' => 'đang chờ duyệt',
                            'processing' => 'đang chuẩn bị',
                            'shipped' => 'đang được giao',
                            'completed' => 'đã giao thành công',
                            'canceled' => 'đã bị hủy',
                        ];

                        // Kiểm tra xem có đơn hàng nào ở trạng thái này không
                        foreach ($statusLabels as $status => $message) {
                            if ($orders->contains('status', $status)) {
                                $statusMessages[] = $message;
                            }
                        }
                    @endphp
                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        @if (auth('frontend')->check())
                            <div @class([
                                'icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11',
                                'icon-header-noti' => !$orders->isEmpty(),
                            ]) id="notification-icon"
                                @if (!$orders->isEmpty()) data-notify="{{ $orders->count() }}" @endif>
                                <i class="fa-regular fa-bell"></i>
                            </div>
                            <div class="notification-dropdown" id="notification-dropdown">
                                <div class="notification-header">Thông báo đơn hàng</div>
                                <ul>
                                    @if (!$orders->isEmpty())
                                        @foreach ($orders as $order)
                                            <li>
                                                <div class="notification-icon">
                                                    <i class="fa-solid fa-box"></i>
                                                </div>
                                                <div class="notification-text">
                                                    Đơn hàng #{{ $order->id }} -
                                                    <span class="badge badge-{{ $order->status }}">
                                                        {{ $statusLabels[$order->status] ?? 'Không xác định' }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <div class="notification-text">Không có đơn hàng nào</div>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                            <div class="cart-content">
                                <x-cart-component></x-cart-component>
                            </div>
                        @endif

                        {{-- <a href="{{ route('fr.login') }}"
                            class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
                            @auth('frontend')
                                <!-- Nếu đã đăng nhập, hiển thị icon đăng xuất và thực hiện hành động đăng xuất -->
                                <form action="{{ route('fr.logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="icon-btn">
                                        <i class="fa-solid fa-right-from-bracket"></i> <!-- Icon đăng xuất -->
                                    </button>
                                </form>
                            @else
                                <!-- Nếu chưa đăng nhập, hiển thị icon tài khoản -->
                                <i class="zmdi zmdi-account"></i> <!-- Icon tài khoản -->
                            @endauth
                        </a> --}}

                        @auth('frontend')
                            <!-- Avatar + Dropdown -->
                            @php
                                $user = auth('frontend')->user();
                            @endphp

                            <div class="dropdown">
                                <img src="{{ asset($user->thumb) }}" alt="avatar" class="rounded-circle"
                                    style="width:35px;height:35px;cursor:pointer;" id="userDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('fr.user.profile') }}">
                                            <i class="fa-regular fa-user"></i> Hồ sơ cá nhân
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('fr.order.list') }}">
                                            <i class="fa-solid fa-box"></i> Đơn hàng của tôi
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('fr.logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <!-- Nếu chưa đăng nhập, hiển thị icon tài khoản -->
                            <a href="{{ route('fr.login') }}"
                                class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
                                <i class="zmdi zmdi-account"></i>
                            </a>
                        @endauth




                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html">
                    <img src="/template/admin/dist/img/download.jpg" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: .8; width: 50px; height: 120px; border-radius: 50%; margin-top:10px;">
                    <span class="brand-text"
                        style="font-family: 'Lobster', cursive; font-size: 32px; color: #ff6347; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); padding-left: 60px;">PMSTORE</span>
                </a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">

                @if (auth('frontend')->check())
                    <div @class([
                        'icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11',
                        'icon-header-noti' => !$orders->isEmpty(),
                    ]) id="notification-icon">
                        <i class="fa-regular fa-bell"></i>
                        @if (!$orders->isEmpty())
                            <span class="notification-dot"></span>
                        @endif
                    </div>
                    <div class="notification-dropdown" id="notification-dropdown">
                        <div class="notification-header">Thông báo đơn hàng</div>
                        <ul>
                            @if (!$orders->isEmpty())
                                @foreach ($orders as $order)
                                    <li>
                                        <div class="notification-icon">
                                            <i class="fa-solid fa-box"></i>
                                        </div>
                                        <div class="notification-text">
                                            Đơn hàng #{{ $order->id }} -
                                            <span class="badge badge-{{ $order->status }}">
                                                {{ $statusLabels[$order->status] ?? 'Không xác định' }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <div class="notification-text">Không có đơn hàng nào</div>
                                </li>
                            @endif

                        </ul>
                    </div>
                    {{-- <div class="cart-content">
                        <x-cart-component></x-cart-component>
                    </div> --}}
                @endif

                <a href="{{ route('fr.login') }}"
                    class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
                    @auth('frontend')
                        <!-- Nếu đã đăng nhập, hiển thị icon đăng xuất và thực hiện hành động đăng xuất -->
                        <form action="{{ route('fr.logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="icon-btn">
                                <i class="fa-solid fa-right-from-bracket"></i> <!-- Icon đăng xuất -->
                            </button>
                        </form>
                    @else
                        <!-- Nếu chưa đăng nhập, hiển thị icon tài khoản -->
                        <i class="zmdi zmdi-account"></i> <!-- Icon tài khoản -->
                    @endauth
                </a>

            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">

            <ul class="main-menu-m">
                <li class="active-menu">
                    <a href="{{ route('fr.homepage') }}">Trang chủ</a>
                </li>

                <li>
                    <a href="{{ route('fr.product') }}">Cửa hàng</a>
                </li>


                <li>
                    <a href="{{ route('fr.about') }}">Giới thiệu</a>
                </li>

                <li>
                    <a href="{{ route('fr.contact') }}">Liên hệ</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>
</div>


<script>
const notificationIcon = document.getElementById("notification-icon");
const notificationDropdown = document.getElementById("notification-dropdown");

notificationIcon.addEventListener("click", function(event) {
    event.stopPropagation();
    notificationDropdown.classList.toggle("active");
});

document.addEventListener("click", function(event) {
    if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
        notificationDropdown.classList.remove("active");
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
