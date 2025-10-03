@props(['order'])

<div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Chi tiết đơn hàng #{{ $order->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
                <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->email }}</p>
                <p><strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Thanh toán:</strong> {{ $order->payment_method }} - {{ $order->payment_status == 'success' ? 'Đã thanh toán' : 'Chưa thanh toán' }}</p>
                
                <hr>
                <h6>Sản phẩm:</h6>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ optional($item->size)->name ?? 'Không có size' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price,0,',','.') }}đ</td>
                            <td>{{ number_format($item->price * $item->quantity,0,',','.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="text-end"><strong>Tổng tiền:</strong> {{ number_format($order->total_price,0,',','.') }}đ</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
