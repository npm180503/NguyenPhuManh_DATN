@extends('frontend.layout')

@section('content')
    <style>
        :root {
            --gold: #c6a353;
            --gold-dark: #a9852e;
            --ink: #111;
            --muted: #6b7280;
            --line: rgba(0, 0, 0, .08);
            --bg: #f7f8fb;
            --card: #fff;
            --danger: #9f1239;
            --ok: #0b6a58;
        }

        body {
            background: var(--bg);
        }

        .page-title {
            font-weight: 800;
            text-align: center;
            letter-spacing: .8px;
            background: linear-gradient(90deg, var(--gold), var(--gold-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .od-wrap {
            background: var(--card);
            border-radius: 18px;
            border: 1px solid var(--line);
            box-shadow: 0 10px 40px rgba(0, 0, 0, .08);
            padding: 2.5rem;
        }

        .card-lux {
            border: 1px solid var(--line);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, .05);
        }

        .card-lux .card-header {
            background: #fafafa;
            border-bottom: 1px solid var(--line);
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            font-weight: 700;
        }

        .btn-gold {
            background: linear-gradient(135deg, #d4af37, var(--gold), var(--gold-dark));
            color: #111;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: .75rem 1.5rem;
            transition: .25s;
            box-shadow: 0 6px 16px rgba(198, 163, 83, .28);
        }

        .btn-gold:hover {
            transform: translateY(-2px);
        }

        .btn-outline-dark {
            border: 2px solid #111;
            border-radius: 12px;
            padding: .75rem 1.5rem;
            font-weight: 700;
            transition: .25s;
        }

        .btn-outline-dark:hover {
            background: #111;
            color: #fff;
        }

        .table {
            border: 1px solid var(--line);
            border-radius: 14px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(90deg, #fafafa, #f3f3f3);
        }

        .table th {
            text-transform: uppercase;
            font-size: .9rem;
            font-weight: 700;
        }

        .table tbody tr:hover {
            background: #fffdf5;
        }

        input.form-control,
        select.form-select {
            border-radius: 10px;
            border: 1px solid #ddd;
            transition: .2s;
        }

        input.form-control:focus,
        select.form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(198, 163, 83, .25);
        }

        .alert {
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, .08);
        }
    </style>

    <div class="container py-5 mt-4">
        <div class="od-wrap">
            <h2 class="page-title mb-4">SỬA ĐƠN HÀNG</h2>
            <div class="text-center mb-3">
                <span class="badge rounded-pill text-dark"
                    style="background:#fff;border:1px solid var(--line);padding:.5rem .9rem">
                    Mã đơn: <strong>#{{ $order->order_code }}</strong>
                </span>
            </div>

            {{-- Error Alerts --}}
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

            {{-- FORM --}}
            <form action="{{ route('fr.order.update', $order->order_code) }}" method="POST">
                @csrf

                {{-- Thông tin khách hàng --}}
                <div class="card card-lux mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-user me-2"></i>Thông tin khách hàng</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Tên khách hàng</label>
                                <input type="text" name="customer_name" class="form-control"
                                    value="{{ old('customer_name', $order->customer_name) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Số điện thoại</label>
                                <input type="text" name="customer_phone" class="form-control"
                                    value="{{ old('customer_phone', $order->customer_phone) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Địa chỉ giao hàng</label>
                                <input type="text" name="customer_address" class="form-control"
                                    value="{{ old('customer_address', $order->customer_address) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $order->email) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Danh sách sản phẩm --}}
                <div class="card card-lux mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-box-open me-2"></i>Danh sách sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
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
                                                <select name="sizes[{{ $item->id }}]" class="form-select" disabled>
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
                                                    data-price="{{ $item->price }}" data-item-id="{{ $item->id }}" disabled>
                                            </td>
                                            <td class="text-end">{{ number_format($item->price, 0, ',', '.') }}đ</td>
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
                </div>

                {{-- Buttons --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-gold me-2">
                        <i class="fas fa-save me-1"></i> Cập nhật đơn hàng
                    </button>
                    <a href="{{ route('fr.order.detail', $order->order_code) }}" class="btn btn-outline-dark">
                        <i class="fas fa-arrow-left me-1"></i> Hủy
                    </a>
                </div>
            </form>
        </div>
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

                document.getElementById('grand-total').textContent = formatCurrency(totalPrice);
            }

            quantityInputs.forEach(input => input.addEventListener('input', updateTotals));
            updateTotals();
        });
    </script>
@endsection
