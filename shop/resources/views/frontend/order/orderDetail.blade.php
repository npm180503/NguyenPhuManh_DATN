@extends('frontend.layout')

@section('content')
<style>
        .badge-pending {
        background-color: orange;
        /* Chờ duyệt */
    }

    .badge-processing {
        background-color: blue;
        /* Đang chuẩn bị */
    }

    .badge-shipped {
        background-color: purple;
        /* Đang giao */
    }

    .badge-completed {
        background-color: green;
        /* Giao thành công */
    }

    .badge-canceled {
        background-color: red;
        /* Đã hủy */
    }
</style>
    <div class="container py-5 mt-5">
        <h2 class="mb-4 text-center">Chi tiết đơn hàng
            <span class="text-primary">#{{ $order->order_code }}</span>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 zindex-tooltip"
                    role="alert" id="flash-success" style="min-width:300px;">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 zindex-tooltip"
                    role="alert" id="flash-error" style="min-width:300px;">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


        </h2>

        <!-- Thông tin đơn hàng -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Thông tin đơn hàng</h5>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Địa chỉ giao hàng:</strong> {{ $order->customer_address }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                    </div>
                    <div class="col-md-6">
                        @php
                            // Danh sách trạng thái & thông báo tương ứng
                            $statusLabels = [
                                'pending' => 'đang chờ duyệt',
                                'processing' => 'đang chuẩn bị',
                                'shipped' => 'đang được giao',
                                'completed' => 'đã giao thành công',
                                'canceled' => 'đã bị hủy',
                            ];

                            // Lấy message tương ứng theo status
                            $statusMessage = $statusLabels[$order->status] ?? 'Không xác định';
                        @endphp

                        <p>
                            <strong>Trạng thái đơn hàng:</strong>
                            <span class="badge badge-{{ $order->status }}">{{ $statusMessage }}</span>
                        </p>

                        <p>
                            <strong>Trạng thái thanh toán:</strong>
                            <span class="badge {{ $order->payment_status == 'success' ? 'bg-success' : 'bg-warning' }}">
                                {{ $order->payment_status == 'success' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                            </span>
                        </p>
                        <p>
                            <strong>Phương thức thanh toán:</strong>
                            <span class="badge bg-info text-dark">{{ $order->payment_method }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Danh sách sản phẩm</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Size</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-end">Giá</th>
                            <th class="text-end">Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->size->name }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                <td class="text-end">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Tổng cộng:</th>
                            <th class="text-end text-danger">
                                {{ number_format($order->total_price, 0, ',', '.') }}đ
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('fr.product') }}" class="btn btn-primary px-4">Tiếp tục mua hàng</a>

            @if (in_array($order->status, ['pending', 'processing']))
                <a href="{{ route('fr.order.edit', $order->order_code) }}" class="btn btn-warning px-4 ms-2">
                    Sửa đơn hàng
                </a>
                <form action="{{ route('fr.order.cancel', $order->order_code) }}" method="POST"
                    class="d-inline-block ms-2" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4">Hủy đơn hàng</button>
                </form>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashSuccess = document.getElementById('flash-success');
            const flashError = document.getElementById('flash-error');

            if (flashSuccess) {
                setTimeout(() => {
                    flashSuccess.classList.remove('show');
                    flashSuccess.classList.add('hide');
                }, 3000); // 3 giây tự ẩn
            }

            if (flashError) {
                setTimeout(() => {
                    flashError.classList.remove('show');
                    flashError.classList.add('hide');
                }, 4000); // 4 giây tự ẩn
            }
        });
    </script>
@endsection
