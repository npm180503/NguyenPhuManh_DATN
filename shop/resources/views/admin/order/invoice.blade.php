<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hóa đơn #{{ $order->order_code }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .customer-info,
        .order-info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>HÓA ĐƠN</h1>
        <p>Mã đơn hàng: {{ $order->order_code }}</p>
        <p>Ngày: {{ $order->created_at->format('d-m-Y H:i') }}</p>
    </div>

    <div class="customer-info">
        <strong>Khách hàng:</strong> {{ $order->customer_name ?? ($order->user->name ?? 'N/A') }} <br>
        <strong>Email:</strong> {{ $order->email ?? ($order->user->email ?? 'N/A') }} <br>
        <strong>Địa chỉ:</strong> {{ $order->customer_address ?? 'N/A' }} <br>
        <strong>SĐT:</strong> {{ $order->customer_phone ?? 'N/A' }} <br>
        <strong>Thanh Toán:</strong> {{ $order->payment_method }} -
        {{ $order->payment_status == 'success' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
    </div>

    <div class="order-info">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 1; @endphp
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ $item->size->name ?? 'N/A' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Tổng tiền: {{ number_format($order->total_price, 0, ',', '.') ?? '0' }}đ</p>

        @if ($order->payment_status == 'success' && $order->payment_method == 'Momo')
            <p><strong>Đơn hàng đã được thanh toán online qua MoMo, tổng tiền phải trả khi nhận 0đ.</strong></p>
        @endif

    </div>

    <p align="center">Xin cảm ơn quý khách đã mua hàng!</p>
</body>

</html>
