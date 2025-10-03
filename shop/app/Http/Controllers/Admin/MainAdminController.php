<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class MainAdminController extends Controller
{

    public function index()
    {
        // Tổng đơn hàng
        $totalOrders = Order::count();

        // Tổng doanh thu (giả sử cột total_price là tổng tiền mỗi đơn)
        $totalRevenue = Order::sum('total_price');

        // Người dùng
       $totalUsers = Customer::count();
        
        // Sản phẩm
        $totalProducts = Product::count();

        $inStock = \App\Models\Product::whereHas('sizes', function ($query) {
            $query->where('quantity', '>', 0);
        })->count();

        $outOfStock = \App\Models\Product::whereDoesntHave('sizes', function ($query) {
            $query->where('quantity', '>', 0);
        })->count();

        $revenueByMonth = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as revenue')
            ->where('status', 'completed')
            ->groupBy('month')
            ->get()
            ->pluck('revenue', 'month')
            ->toArray();
        $orderStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statusLabels = [
            'pending' => 'Chờ duyệt',
            'processing' => 'Đang đóng hàng',
            'shipped' => 'Đang giao hàng',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Hủy'
        ];

        $orderStatusLabels = [];
        $orderStatusData = [];
        foreach ($orderStatus as $status => $count) {
            $orderStatusLabels[] = $statusLabels[$status] ?? ucfirst($status);
            $orderStatusData[] = $count;
        }

        $title = 'Trang quản trị';
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[$i] = $revenueByMonth[$i] ?? 0;
        }
        return view('admin.home', compact(
            'title',
            'totalOrders',
            'totalRevenue',
            'totalUsers',
            'totalProducts',
            'inStock',
            'outOfStock',
            'revenueByMonth',
            'orderStatus',
            'revenueData',
            'orderStatusLabels',
            'orderStatusData'
        ));
    }
}
