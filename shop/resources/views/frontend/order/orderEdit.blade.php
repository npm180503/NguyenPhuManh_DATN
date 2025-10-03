@extends('frontend.layout')

@section('content')
    <div class="container py-5 mt-5">
        <h2 class="mb-4 text-center">Sửa đơn hàng #{{ $order->order_code }}</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('fr.order.update', $order->order_code) }}" method="POST">
            @csrf

            <!-- Thông tin khách hàng -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Thông tin khách hàng</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Tên khách hàng</label>
                            <input type="text" name="customer_name" class="form-control"
                                value="{{ old('customer_name', $order->customer_name) }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="customer_phone" class="form-control"
                                value="{{ old('customer_phone', $order->customer_phone) }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Địa chỉ giao hàng</label>
                            <input type="text" name="customer_address" class="form-control"
                                value="{{ old('customer_address', $order->customer_address) }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control"
                                value="{{ old('email', $order->email) }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danh sách sản phẩm -->
            <div class="card shadow-sm mb-4">
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
                                    <td>
                                        <select name="sizes[{{ $item->id }}]" class="form-select">
                                            @foreach ($item->product->sizes as $sizeOption)
                                                <option value="{{ $sizeOption->id }}"
                                                    {{ $sizeOption->id == $item->size_id ? 'selected' : '' }}>
                                                    {{ $sizeOption->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </td>
                                    <td class="text-center">
                                        <input type="number" name="quantities[{{ $item->id }}]"
                                            value="{{ $item->quantity }}" min="1"
                                            class="form-control text-center quantity-input"
                                            data-price="{{ $item->price }}" data-item-id="{{ $item->id }}">
                                    </td>
                                    <td class="text-end price-cell">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                    <td class="text-end total-cell" id="total-{{ $item->id }}">
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Tổng cộng:</th>
                                <th class="text-end text-danger" id="grand-total">
                                    {{ number_format($order->total_price, 0, ',', '.') }}đ</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>

            <!-- Nút hành động -->
            <div class="text-center mb-5">
                <button type="submit" class="btn btn-success px-4">Cập nhật đơn hàng</button>
                <a href="{{ route('fr.order.detail', $order->order_code) }}" class="btn btn-secondary px-4 ms-2">Hủy</a>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity-input');

            function formatCurrency(num) {
                return num.toLocaleString('vi-VN') + 'đ';
            }

            function updateTotals() {
                let totalPrice = 0;
                quantityInputs.forEach(input => {
                    const qty = parseInt(input.value) || 0;
                    const price = parseInt(input.dataset.price) || 0;
                    const itemId = input.dataset.itemId;

                    const itemTotal = qty * price;
                    document.getElementById('total-' + itemId).textContent = formatCurrency(itemTotal);
                    totalPrice += itemTotal;
                });

                // Cập nhật tổng cộng
                document.getElementById('grand-total').textContent = formatCurrency(totalPrice);
            }

            quantityInputs.forEach(input => {
                input.addEventListener('input', updateTotals);
            });

            updateTotals(); // gọi 1 lần lúc load trang
        });
    </script>

@endsection
