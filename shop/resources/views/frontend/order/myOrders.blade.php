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
    <h2 class="mb-4 text-center">Đơn hàng của tôi</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            Bạn chưa có đơn hàng nào.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->order_code }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
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
                            <td>
                                <span class="badge badge-{{ $order->status }}">{{ $statusMessage }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $order->payment_status == 'success' ? 'bg-success' : 'bg-warning' }}">
                                    {{ $order->payment_status == 'success' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                </span>
                            </td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                            <td>
                                <a href="{{ route('fr.order.detail', $order->order_code) }}" class="btn btn-sm btn-info">
                                    Xem
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
