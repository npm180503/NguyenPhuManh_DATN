@extends('admin.main')

@section('content')
    <style>
        .tab-link {
            color: black;
            text-decoration: none;
            font-size: 16px;
            margin-left: 20px;
        }

        .active-tab {
            font-weight: bold;
            text-decoration: underline;
            color: #007bff;
        }

        a {
            color: black;
            text-decoration: none;
            font-size: 16px;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .admin-reply {
            margin-left: 20px;
            font-style: italic;
            color: #007bff;
        }
    </style>

    <div class="mb-3">
        <a href="{{ route('admin.order.pending') }}"
            class="tab-link {{ request()->routeIs('admin.order.pending') ? 'active-tab' : '' }}">
            Đang duyệt ({{ \App\Models\Order::where('status', 'pending')->count() }})
        </a> |
        <a href="{{ route('admin.order.processing') }}"
            class="tab-link {{ request()->routeIs('admin.order.processing') ? 'active-tab' : '' }}">
            Đang đóng hàng ({{ \App\Models\Order::where('status', 'processing')->count() }})
        </a> |
        <a href="{{ route('admin.order.shipped') }}"
            class="tab-link {{ request()->routeIs('admin.order.shipped') ? 'active-tab' : '' }}">
            Đang giao ({{ \App\Models\Order::where('status', 'shipped')->count() }})
        </a> |
        <a href="{{ route('admin.order.completed') }}"
            class="tab-link {{ request()->routeIs('admin.order.completed') ? 'active-tab' : '' }}">
            Giao thành công ({{ \App\Models\Order::where('status', 'completed')->count() }})
        </a> |
        <a href="{{ route('admin.order.canceled') }}"
            class="tab-link {{ request()->routeIs('admin.order.canceled') ? 'active-tab' : '' }}">
            Đã hủy ({{ \App\Models\Order::where('status', 'canceled')->count() }})
        </a>

    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>SĐT</th>
                <th>Trạng thái</th>
                <th>Thanh toán</th>
                <th>Sản phẩm</th>
                <th>Tổng tiền</th>
                <th>Thao tác</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>
                        <span
                            class="badge 
                    @if ($order->status == 'pending') bg-primary
                    @elseif($order->status == 'processing') bg-info
                    @elseif($order->status == 'shipped') bg-warning
                    @elseif($order->status == 'completed') bg-success
                    @elseif($order->status == 'canceled') bg-danger
                    @else bg-secondary @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $order->payment_status == 'success' ? 'bg-success' : 'bg-warning' }}">
                            {{ $order->payment_method }} -
                            {{ $order->payment_status == 'success' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                        </span>
                    </td>
                    <td>{{ $order->orderItems->count() }} sp</td>
                    <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                    <td>
                        <!-- Nút Xem -->
                        <button type="button" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal"
                            data-bs-target="#orderModal{{ $order->id }}">
                            Xem
                        </button>

                        <!-- Nút Xuất hóa đơn -->
                        <a href="{{ route('admin.order.invoice', $order->id) }}" class="btn btn-primary">Xuất hóa đơn</a>


                        @if ($order->status == 'pending')
                            <form action="{{ route('admin.order.markAsProcessing', $order->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm mb-1">Chuẩn bị</button>
                            </form>
                            <form action="{{ route('admin.order.markAsCanceled', $order->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm mb-1"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </form>
                        @elseif ($order->status == 'processing')
                            <form action="{{ route('admin.order.markAsShipped', $order->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm mb-1">Giao hàng</button>
                            </form>
                            <form action="{{ route('admin.order.markAsCanceled', $order->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm mb-1"><i
                                        class="fa-solid fa-xmark"></i></button>
                            </form>
                        @elseif ($order->status == 'shipped')
                            <form action="{{ route('admin.order.markAsCompleted', $order->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm mb-1">Đã giao</button>
                            </form>
                        @endif
                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($orders as $order)
        @include('admin.order.order-modal', ['order' => $order])
    @endforeach

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (bundle có Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {!! $orders->links() !!}
@endsection
