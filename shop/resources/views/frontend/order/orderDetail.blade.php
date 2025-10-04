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
            --ok: #0b6a58;
            --warn: #92400e;
            --danger: #9f1239;
            --info: #0e7490;
        }

        body {
            background: var(--bg);
        }

        /* ===== Shell ===== */
        .od-wrap {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, .06)
        }

        .page-title {
            font-weight: 800;
            letter-spacing: .8px;
            text-align: center;
            margin-bottom: 1.2rem;
            background: linear-gradient(90deg, var(--gold), var(--gold-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* ===== Status chips ===== */
        .chip {
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
            border-radius: 999px;
            display: inline-block
        }

        .chip-pending {
            background: #fff7ed;
            color: #c2410c;
            border-color: #fed7aa
        }

        .dot-pending {
            background: #fb923c
        }

        .chip-processing {
            background: #eef2ff;
            color: #4338ca;
            border-color: #c7d2fe
        }

        .dot-processing {
            background: #6366f1
        }

        .chip-shipped {
            background: #ecfeff;
            color: #0e7490;
            border-color: #a5f3fc
        }

        .dot-shipped {
            background: #22d3ee
        }

        .chip-completed {
            background: #ecfdf5;
            color: #047857;
            border-color: #a7f3d0
        }

        .dot-completed {
            background: #34d399
        }

        .chip-canceled {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca
        }

        .dot-canceled {
            background: #f87171
        }

        .chip-paid {
            background: #ecfdf5;
            color: var(--ok);
            border: 1px solid #a7f3d0
        }

        .chip-unpaid {
            background: #fff7ed;
            color: var(--warn);
            border: 1px solid #fed7aa
        }

        .chip-method {
            background: #e0f2fe;
            color: #075985;
            border: 1px solid #bae6fd
        }

        /* ===== Stepper (timeline) ===== */
        .stepper {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: .75rem;
            position: relative;
            margin: 1.2rem 0 1.6rem
        }

        .stepper::before {
            content: "";
            position: absolute;
            left: calc(12px);
            right: calc(12px);
            top: 18px;
            height: 3px;
            background: #eee;
            border-radius: 2px;
        }

        .step {
            position: relative;
            text-align: center
        }

        .step .dot-big {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            background: #eee;
            border: 2px solid #e5e7eb;
            margin: 0 auto 6px;
            display: grid;
            place-items: center;
            font-weight: 800;
            color: #777
        }

        .step.done .dot-big {
            background: linear-gradient(135deg, #d4af37, var(--gold), var(--gold-dark));
            color: #111;
            border-color: #d9c07a;
            box-shadow: 0 6px 16px rgba(198, 163, 83, .28)
        }

        .step.active .dot-big {
            background: #fff;
            border-color: var(--gold);
            box-shadow: 0 0 0 4px rgba(198, 163, 83, .15)
        }

        .step .lbl {
            font-size: .9rem;
            color: #333;
            font-weight: 700
        }

        .step .sub {
            font-size: .82rem;
            color: var(--muted)
        }

        /* ===== Cards ===== */
        .card-lux {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 16px;
            box-shadow: 0 8px 26px rgba(0, 0, 0, .05)
        }

        .card-lux .card-header {
            background: #fafafa;
            border-bottom: 1px solid var(--line);
            border-top-left-radius: 16px;
            border-top-right-radius: 16px
        }

        /* ===== Product table ===== */
        .tbl {
            border: 1px solid var(--line);
            border-radius: 14px;
            overflow: hidden;
            background: #fff
        }

        .tbl thead {
            background: linear-gradient(90deg, #fafafa, #f3f3f3)
        }

        .tbl th {
            font-weight: 700;
            text-transform: uppercase;
            font-size: .9rem
        }

        .tbl td {
            vertical-align: middle
        }

        .tbl tbody tr:hover {
            background: #fffdf5
        }

        .thumb {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid #eee;
            margin-right: .5rem
        }

        /* ===== Buttons ===== */
        .btn-gold {
            position: relative;
            display: inline-block;
            border: none;
            border-radius: 12px;
            padding: .75rem 1.4rem;
            font-weight: 700;
            color: #111;
            background: linear-gradient(135deg, #d4af37, var(--gold), var(--gold-dark));
            box-shadow: 0 6px 16px rgba(198, 163, 83, .28);
            transition: .25s;
        }

        .btn-gold:hover {
            transform: translateY(-2px)
        }

        .btn-outline-dark {
            border: 2px solid #111;
            border-radius: 12px;
            font-weight: 700
        }

        .btn-outline-dark:hover {
            background: #111;
            color: #fff
        }

        /* Flash toast */
        .toast-lux {
            min-width: 300px;
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .12)
        }

        /* ... các CSS khác ... */
        .chip-canceled,
        .chip-cancle {
            background: #fef2f2;
            color: #b91c1c;
            border-color: #fecaca;
        }

        .dot-canceled,
        .dot-cancle {
            background: #f87171;
        }
    </style>

    <div class="container py-5 mt-4">
        <div class="od-wrap p-4 p-md-5">
            {{-- Title + Code --}}
            <h2 class="page-title">CHI TIẾT ĐƠN HÀNG</h2>
            <div class="text-center mb-3">
                <span class="badge rounded-pill text-dark"
                    style="background:#fff;border:1px solid var(--line);padding:.5rem .9rem">
                    Mã đơn: <strong>#{{ $order->order_code }}</strong>
                </span>
            </div>

            {{-- Flash messages (lux style) --}}
            @if (session('success'))
                <div class="alert alert-success toast-lux alert-dismissible fade show mx-auto mb-4" role="alert"
                    id="flash-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger toast-lux alert-dismissible fade show mx-auto mb-4" role="alert"
                    id="flash-error">
                    <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- STATUS STEPPER --}}
            @php
                $steps = [
                    'pending' => 'Chờ duyệt',
                    'processing' => 'Chuẩn bị',
                    'shipped' => 'Đang giao',
                    'completed' => 'Hoàn tất',
                    'canceled' => 'Đã hủy',
                ];
                $orderStep = match ($order->status) {
                    'pending' => 1,
                    'processing' => 2,
                    'shipped' => 3,
                    'completed' => 4,
                    default => 1,
                };
            @endphp
            <div class="stepper">
                <div class="step {{ $orderStep >= 1 ? 'done' : '' }} {{ $orderStep == 1 ? 'active' : '' }}">
                    <div class="dot-big">1</div>
                    <div class="lbl">Chờ duyệt</div>
                    <div class="sub">Tạo đơn</div>
                </div>
                <div class="step {{ $orderStep >= 2 ? 'done' : '' }} {{ $orderStep == 2 ? 'active' : '' }}">
                    <div class="dot-big">2</div>
                    <div class="lbl">Chuẩn bị</div>
                    <div class="sub">Đóng gói</div>
                </div>
                <div class="step {{ $orderStep >= 3 ? 'done' : '' }} {{ $orderStep == 3 ? 'active' : '' }}">
                    <div class="dot-big">3</div>
                    <div class="lbl">Đang giao</div>
                    <div class="sub">Đơn vị vận chuyển</div>
                </div>
                <div class="step {{ $orderStep >= 4 ? 'done' : '' }} {{ $orderStep == 4 ? 'active' : '' }}">
                    <div class="dot-big">4</div>
                    <div class="lbl">Hoàn tất</div>
                    <div class="sub">Giao thành công</div>
                </div>
            </div>

            {{-- GRID --}}
            <div class="row g-4">
                {{-- Left: Order & Customer --}}
                <div class="col-lg-7">
                    <div class="card card-lux mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Thông tin đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $statusMap = [
                                    'pending' => [
                                        'label' => 'Đang chờ duyệt',
                                        'chip' => 'chip-pending',
                                        'dot' => 'dot-pending',
                                    ],
                                    'processing' => [
                                        'label' => 'Đang chuẩn bị',
                                        'chip' => 'chip-processing',
                                        'dot' => 'dot-processing',
                                    ],
                                    'shipped' => [
                                        'label' => 'Đang giao',
                                        'chip' => 'chip-shipped',
                                        'dot' => 'dot-shipped',
                                    ],
                                    'completed' => [
                                        'label' => 'Đã giao thành công',
                                        'chip' => 'chip-completed',
                                        'dot' => 'dot-completed',
                                    ],
                                    'canceled' => [
                                        'label' => 'Đã hủy',
                                        'chip' => 'chip-canceled',
                                        'dot' => 'dot-canceled',
                                    ],
                                ];
                                $st = $statusMap[$order->status] ?? [
                                    'label' => 'Không xác định',
                                    'chip' => 'chip-processing',
                                    'dot' => 'dot-processing',
                                ];
                                $paid = $order->payment_status === 'success';
                            @endphp

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2"><span class="text-muted">Khách hàng:</span>
                                        <strong>{{ $order->customer_name }}</strong>
                                    </div>
                                    <div class="mb-2"><span class="text-muted">Số điện thoại:</span>
                                        <strong>{{ $order->customer_phone }}</strong>
                                    </div>
                                    <div class="mb-2"><span class="text-muted">Email:</span>
                                        <strong>{{ $order->email }}</strong>
                                    </div>
                                    <div class="mb-2"><span class="text-muted">Địa chỉ giao hàng:</span>
                                        <strong>{{ $order->customer_address }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <span class="text-muted">Trạng thái đơn hàng:</span>
                                        <span class="chip {{ $st['chip'] }}"><span
                                                class="dot {{ $st['dot'] }}"></span>{{ $st['label'] }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-muted">Thanh toán:</span>
                                        <span class="chip {{ $paid ? 'chip-paid' : 'chip-unpaid' }}">
                                            @if ($paid)
                                                <i class="fas fa-check-circle me-1"></i>Đã thanh toán
                                            @else
                                                <i class="fas fa-clock me-1"></i>Chưa thanh toán
                                            @endif
                                        </span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-muted">Phương thức:</span>
                                        <span class="chip chip-method"><i
                                                class="fas fa-credit-card me-1"></i>{{ strtoupper($order->payment_method) }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-muted">Ngày đặt:</span>
                                        <strong>{{ $order->created_at?->format('d/m/Y H:i') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Products --}}
                    <div class="card card-lux">
                        <div class="card-header">
                            <h5 class="mb-0">Danh sách sản phẩm</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table tbl align-middle">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Size</th>
                                            <th class="text-center">SL</th>
                                            <th class="text-end">Giá</th>
                                            <th class="text-end">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @php $thumb = $item->product->thumbnail_url ?? $item->product->image ?? null; @endphp
                                                        @if ($thumb)
                                                            <img class="thumb me-2" src="{{ $thumb }}"
                                                                alt="{{ $item->product->name }}">
                                                        @endif
                                                        <div>
                                                            <div class="fw-semibold">{{ $item->product->name }}</div>
                                                            @if (!empty($item->product->sku))
                                                                <div class="text-muted small">SKU:
                                                                    {{ $item->product->sku }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->size->name }}</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-end">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                                <td class="text-end">
                                                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-end">Tổng cộng</th>
                                            <th class="text-end text-danger fw-bold">
                                                {{ number_format($order->total_price, 0, ',', '.') }}đ</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Summary / Actions --}}
                <div class="col-lg-5">
                    <div class="card card-lux mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Tóm tắt & thao tác</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tổng tiền hàng</span>
                                <strong>{{ number_format(collect($order->orderItems)->sum(fn($i) => $i->price * $i->quantity), 0, ',', '.') }}đ</strong>
                            </div>
                            @if (!empty($order->shipping_fee))
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Phí vận chuyển</span>
                                    <strong>{{ number_format($order->shipping_fee, 0, ',', '.') }}đ</strong>
                                </div>
                            @endif
                            @if (!empty($order->discount_amount))
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Giảm giá</span>
                                    <strong>-{{ number_format($order->discount_amount, 0, ',', '.') }}đ</strong>
                                </div>
                            @endif
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h6 mb-0">Tổng thanh toán</span>
                                <span
                                    class="h5 mb-0 text-danger">{{ number_format($order->total_price, 0, ',', '.') }}đ</span>
                            </div>

                            <div class="mt-4 d-flex flex-wrap gap-2">
                                <a href="{{ route('fr.product') }}" class="btn btn-outline-dark"><i
                                        class="fas fa-store me-1"></i> Tiếp tục mua</a>

                                @if (in_array($order->status, ['pending', 'processing']))
                                    <a href="{{ route('fr.order.edit', $order->order_code) }}" class="btn btn-gold"><i
                                            class="fas fa-pen-to-square me-1"></i> Sửa đơn hàng</a>
                                    <form action="{{ route('fr.order.cancel', $order->order_code) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-dark"><i
                                                class="fas fa-ban me-1"></i> Hủy đơn hàng</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Shipping note --}}
                    <div class="card card-lux">
                        <div class="card-header">
                            <h6 class="mb-0">Ghi chú giao hàng</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-muted small">
                                Hàng sẽ được giao trong giờ hành chính. Vui lòng giữ liên lạc khi shipper gọi đến để nhận
                                hàng nhanh chóng.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Auto-hide flash --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const s = document.getElementById('flash-success'),
                e = document.getElementById('flash-error');
            if (s) setTimeout(() => s.classList.remove('show'), 3000);
            if (e) setTimeout(() => e.classList.remove('show'), 4000);
        });
    </script>
@endsection
