@extends('admin.main')

@section('content')
<div class="row">
    <!-- Tổng đơn hàng -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalOrders }}</h3>
                <p>Tổng đơn hàng</p>
            </div>
            <div class="icon"><i class="fas fa-shopping-cart"></i></div>
        </div>
    </div>

    <!-- Doanh thu -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ number_format($totalRevenue, 0, ',', '.') }}đ</h3>
                <p>Tổng doanh thu</p>
            </div>
            <div class="icon"><i class="fas fa-dollar-sign"></i></div>
        </div>
    </div>

    <!-- Người dùng -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Người dùng</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
        </div>
    </div>

    <!-- Sản phẩm -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalProducts }}</h3>
                <p>Sản phẩm ({{ $inStock }} còn / {{ $outOfStock }} hết)</p>
            </div>
            <div class="icon"><i class="fas fa-box"></i></div>
        </div>
    </div>
</div>

<!-- Biểu đồ -->
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Doanh thu theo tháng</h3></div>
            <div class="card-body" style="min-height:320px">
                <canvas id="revenueChart" style="height:300px; width:100%"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header"><h3 class="card-title">Đơn hàng theo trạng thái</h3></div>
            <div class="card-body" style="min-height:320px">
                <canvas id="orderStatusChart" style="height:300px; width:100%"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- load Chart.js 1 lần ở đây (cuối body) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // dữ liệu từ server
    const revenueData = @json($revenueData); // array length 12
    const orderLabels = @json($orderStatusLabels);
    const orderData = @json($orderStatusData);

    console.log('revenueData', revenueData);
    console.log('orderLabels', orderLabels);
    console.log('orderData', orderData);

    // Revenue chart
    const revenueCanvas = document.getElementById('revenueChart');
    if (revenueCanvas) {
        const ctx = revenueCanvas.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: [...Array(12).keys()].map(i => `Tháng ${i+1}`),
                datasets: [{
                    label: 'Doanh thu',
                    data: revenueData,
                    borderColor: 'rgba(75,192,192,1)',
                    backgroundColor: 'rgba(75,192,192,0.15)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        ticks: {
                            callback: function(v){ return v ? v.toLocaleString('vi-VN') + ' ₫' : '0'; }
                        }
                    }
                }
            }
        });
    }

    // Order status chart
    const orderCanvas = document.getElementById('orderStatusChart');
    if (orderCanvas) {
        const ctx2 = orderCanvas.getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: orderLabels,
                datasets: [{
                    data: orderData,
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
});
</script>
@endsection
