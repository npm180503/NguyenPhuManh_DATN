@extends('frontend.layout')

@section('content')
    <style>
        :root {
            --lux-gold: #c6a353;
            --lux-gold-dark: #a9852e;
            --ink: #1a1a1a;
            --muted: #6b7280;
            --line: rgba(0, 0, 0, .08);
            --bg: #f8f9fb;
        }

        body {
            background: var(--bg);
        }

        /* Khung trang */
        .orders-wrap {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .06);
            padding: 2.2rem;
        }

        .page-title {
            font-weight: 800;
            letter-spacing: .8px;
            background: linear-gradient(90deg, var(--lux-gold), var(--lux-gold-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Empty state */
        .empty-card {
            background: linear-gradient(180deg, #fff 0%, #fdf7e7 100%);
            border: 1px solid #f0e2b5;
            border-radius: 16px;
            box-shadow: 0 8px 28px rgba(198, 163, 83, .18);
            padding: 3rem 2rem;
        }

        .btn-lux {
            position: relative;
            display: inline-block;
            border: none;
            border-radius: 12px;
            padding: .75rem 1.6rem;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #d4af37, var(--lux-gold), var(--lux-gold-dark));
            box-shadow: 0 4px 15px rgba(212, 175, 55, .35);
            transition: .3s;
        }

        .btn-lux::after {
            content: "";
            position: absolute;
            top: 0;
            left: -80px;
            width: 60px;
            height: 100%;
            background: linear-gradient(120deg, rgba(255, 255, 255, .5), rgba(255, 255, 255, 0));
            transform: skewX(-20deg);
            transition: .6s
        }

        .btn-lux:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, .45)
        }

        .btn-lux:hover::after {
            left: 120%
        }

        .btn-outline-dark {
            border: 2px solid #111;
            border-radius: 12px;
            font-weight: 600;
            padding: .75rem 1.6rem
        }

        .btn-outline-dark:hover {
            background: #111;
            color: #fff
        }

        /* Bảng */
        .orders-table {
            border: 1px solid var(--line);
            border-radius: 16px;
            overflow: hidden;
            background: #fff
        }

        .orders-table thead {
            background: linear-gradient(90deg, #fafafa, #f3f3f3)
        }

        .orders-table th {
            font-weight: 700;
            color: #111;
            text-transform: uppercase;
            font-size: .9rem
        }

        .orders-table td {
            vertical-align: middle
        }

        .orders-table tbody tr:hover {
            background: #fffdf5
        }

        /* Badge trạng thái (sang trọng) */
        .badge-chip {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .42rem .8rem;
            border-radius: 999px;
            font-weight: 600;
            border: 1px solid transparent
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block
        }

        .badge-pending {
            background: #fff7ed;
            color: #c2410c;
            border-color: #fed7aa
        }

        .dot-pending {
            background: #fb923c
        }

        .badge-processing {
            background: #eef2ff;
            color: #4338ca;
            border-color: #c7d2fe
        }

        .dot-processing {
            background: #6366f1
        }

        .badge-shipped {
            background: #ecfeff;
            color: #0e7490;
            border-color: #a5f3fc
        }

        .dot-shipped {
            background: #22d3ee
        }

        .badge-completed {
            background: #ecfdf5;
            color: #047857;
            border-color: #a7f3d0
        }

        .dot-completed {
            background: #34d399
        }

        .badge-canceled {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca
        }

        .dot-canceled {
            background: #f87171
        }

        /* Badge thanh toán */
        .paid {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0
        }

        .unpaid {
            background: #fff7ed;
            color: #92400e;
            border: 1px solid #fed7aa
        }

        /* Nhẹ nhàng xuất hiện */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .orders-table,
        .empty-card {
            animation: fadeUp .45s ease
        }

        /* Ẩn control của DataTables nếu lỡ bị khởi tạo */
        #ordersTable_wrapper .dataTables_info,
        #ordersTable_wrapper .dataTables_paginate,
        #ordersTable_wrapper .dataTables_length,
        #ordersTable_wrapper .dataTables_filter {
            display: none !important;
        }

        /* Luxury pagination (áp dụng cho Laravel links()) */
        .lux-paginate nav {
            display: flex;
            justify-content: center;
        }

        .lux-paginate .pagination {
            gap: .25rem;
        }

        .lux-paginate .page-link {
            border: 1px solid #e9e9ee;
            background: #fff;
            color: #333;
            padding: .55rem .9rem;
            border-radius: 10px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
            transition: .2s;
        }

        .lux-paginate .page-link:hover {
            border-color: #d9d9e0;
            transform: translateY(-1px);
        }

        .lux-paginate .page-item.active .page-link {
            background: linear-gradient(135deg, #d4af37, #c6a353, #a9852e);
            border-color: #c6a353;
            color: #111;
            box-shadow: 0 6px 16px rgba(198, 163, 83, .28);
        }

        .lux-paginate .page-item.disabled .page-link {
            opacity: .5;
            box-shadow: none;
        }
    </style>

    <div class="container py-5 mt-4">
        <div class="orders-wrap">
            <h2 class="page-title text-center mb-4">ĐƠN HÀNG CỦA TÔI</h2>

            @if ($orders->isEmpty())
                <div class="empty-card text-center">
                    <svg width="90" height="90" viewBox="0 0 24 24" fill="none" class="mb-2">
                        <path d="M4 15c2 0 3.5-1 5-3l2 2c1 1 2 1 4 1h3a2 2 0 0 1 2 2v1H3a2 2 0 0 1-2-2v-1h3Z"
                            stroke="url(#g1)" stroke-width="1.6" />
                        <defs>
                            <linearGradient id="g1" x1="0" x2="24" y1="0" y2="24">
                                <stop stop-color="#c6a353" />
                                <stop offset="1" stop-color="#a9852e" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <h4 class="fw-bold">Bạn chưa có đơn hàng nào</h4>
                    <p class="text-muted mb-3">Khám phá ngay bộ sưu tập sneaker mới nhất — đơn hàng đầu tiên của bạn sẽ tỏa
                        sáng tại đây!</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('fr.product') }}" class="btn btn-lux">
                            <i class="fas fa-shopping-bag me-1"></i> Tiếp tục mua sắm
                        </a>
                        <a href="{{ route('fr.homepage') ?? url('/') }}" class="btn btn-outline-dark">
                            <i class="fas fa-home me-1"></i> Về trang chủ
                        </a>
                    </div>
                </div>
            @else
                <div class="table-responsive">
                    <table id="ordersTable" class="table orders-table align-middle table orders-table align-middle">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Thanh toán</th>
                                <th class="text-end">Tổng tiền</th>
                                <th class="text-center">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $statusMap = [
                                        'pending' => ['label' => 'Đang chờ duyệt', 'dot' => 'dot-pending'],
                                        'processing' => ['label' => 'Đang chuẩn bị', 'dot' => 'dot-processing'],
                                        'shipped' => ['label' => 'Đang giao', 'dot' => 'dot-shipped'],
                                        'completed' => ['label' => 'Đã giao thành công', 'dot' => 'dot-completed'],
                                        'canceled' => ['label' => 'Đã hủy', 'dot' => 'dot-canceled'],
                                    ];
                                    $st = $statusMap[$order->status] ?? [
                                        'label' => 'Không xác định',
                                        'dot' => 'dot-processing',
                                    ];
                                    $paid = $order->payment_status === 'success';
                                @endphp
                                <tr>
                                    <td class="fw-bold">#{{ $order->order_code }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge-chip badge-{{ $order->status }}">
                                            <span class="dot {{ $st['dot'] }}"></span>{{ $st['label'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-chip {{ $paid ? 'paid' : 'unpaid' }}">
                                            @if ($paid)
                                                <i class="fas fa-check-circle me-1"></i> Đã thanh toán
                                            @else
                                                <i class="fas fa-clock me-1"></i> Chưa thanh toán
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold">{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                                    <td class="text-center">
                                        <a href="{{ route('fr.order.detail', $order->order_code) }}"
                                            class="btn btn-lux btn-sm px-3">Xem</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Phân trang --}}
                @if (method_exists($orders, 'links'))
                    <div class="mt-3 d-flex justify-content-center">
                        @if ($orders instanceof \Illuminate\Pagination\LengthAwarePaginator && $orders->hasPages())
                            <nav class="lux-paginate" aria-label="Pagination">
                                <ul class="pagination">
                                    {{-- Prev --}}
                                    <li class="page-item {{ $orders->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $orders->previousPageUrl() ?: '#' }}" rel="prev"
                                            aria-label="Trước">&laquo;</a>
                                    </li>

                                    {{-- Numbers --}}
                                    @php
                                        $start = max(1, $orders->currentPage() - 1);
                                        $end = min($orders->lastPage(), $orders->currentPage() + 1);
                                        if ($start > 1) {
                                            echo '<li class="page-item"><a class="page-link" href="' .
                                                $orders->url(1) .
                                                '">1</a></li>';
                                            if ($start > 2) {
                                                echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
                                            }
                                        }
                                    @endphp

                                    @for ($page = $start; $page <= $end; $page++)
                                        <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $orders->url($page) }}">{{ $page }}</a>
                                        </li>
                                    @endfor

                                    @php
                                        if ($end < $orders->lastPage() - 1) {
                                            echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
                                        }
                                        if ($end < $orders->lastPage()) {
                                            echo '<li class="page-item"><a class="page-link" href="' .
                                                $orders->url($orders->lastPage()) .
                                                '">' .
                                                $orders->lastPage() .
                                                '</a></li>';
                                        }
                                    @endphp

                                    {{-- Next --}}
                                    <li class="page-item {{ $orders->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $orders->nextPageUrl() ?: '#' }}" rel="next"
                                            aria-label="Sau">&raquo;</a>
                                    </li>
                                </ul>
                            </nav>
                        @endif

                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
