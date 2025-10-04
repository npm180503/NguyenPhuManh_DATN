<?php

namespace App\Http\Controllers\FrontEnd;

// use App\Http\Business\Cart;
use App\Http\Controllers\Controller;
use App\Http\Services\About\AboutAdminService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Str;
use App\Mail\OrderInvoiceMail;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    const PAYMENT_SUCCESS = "success";

    public function store(Request $request)
    {
        $cart = Cart::where('user_id', auth('frontend')->id())->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Giỏ hàng rỗng'
            ], 400);
        }

        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Giỏ hàng không có sản phẩm'
            ], 400);
        }

        $order = null; // để dùng sau transaction

        DB::transaction(function () use ($request, $cartItems, &$order, $cart) {
            $total = 0;

            foreach ($cartItems as $item) {
                $total += $item->quantity * ($item->product->price_sale ?? $item->product->price);
            }

            $order = Order::create([
                'user_id'          => auth("frontend")->id() ?? null,
                'order_code'       =>  Str::upper(Str::random(10)),
                'customer_name'    => $request->name,
                'customer_phone'   => $request->phone,
                'customer_address' => $request->address,
                'email'            => $request->email,
                'status'           => 'pending',
                'total_price'      => $total,
                'payment_method'   => $request->payment_method,
            ]);
            foreach ($cartItems as $item) {
                $product = resolve(ProductService::class)->product($item->product_id);
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product->id,
                    'quantity'   => $item->quantity,
                    'size_id'    => $item->size_id,
                    'price'      => $item->product->price_sale ?? $item->product->price,
                ]);
                $size = $product->sizes->where('id', $item->size_id)->first();
                $size->pivot->quantity -= $item->quantity;
                if ($size->pivot->quantity < 0) {
                    throw new \Exception("Số lượng sản phẩm trong kho không đủ: " . $product->name . " - Size: " . $size->name);
                }
                $size->pivot->save();
            }
            CartItem::where('cart_id', $cart->id)->delete();
            $cart->delete();
        });



        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể tạo đơn hàng'
            ], 500);
        }

        $order = Order::with('orderItems.product', 'orderItems.size')->find($order->id);

        return response()->json([
            'success'        => true,
            'order_id'       => $order->order_code,
            'payment_method' => $order->payment_method,
        ]);
    }


    public function momoCallback()
    {
        $accessKey = "F8BBA842ECF85"; // của bạn
        $secretKey = "K951B6PE1waDMi640xX08PD3vg6EkVlz"; // của bạn

        // Lấy tất cả dữ liệu MoMo trả về
        $data = request()->all();
        // dd($data);
        $rawHash = "accessKey=" . $accessKey .
            "&amount=" . $data["amount"] .
            "&extraData=" . $data["extraData"] .
            "&message=" . $data["message"] .
            "&orderId=" . $data["orderId"] .
            "&orderInfo=" . $data["orderInfo"] .
            "&orderType=" . $data["orderType"] .
            "&partnerCode=" . $data["partnerCode"] .
            "&payType=" . $data["payType"] .
            "&requestId=" . $data["requestId"] .
            "&responseTime=" . $data["responseTime"] .
            "&resultCode=" . $data["resultCode"] .
            "&transId=" . $data["transId"];

        // Tính lại signature
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        if ($signature != $data["signature"]) {
            abort(404);
        }
        $order = Order::where("order_code", $data["orderId"])->first();
        if (!$order) {
            abort(404);
        }
        if ($order->total_price != $data["amount"]) {
            abort(404);
        }

        if ($data["resultCode"] == 0) {
            $order->update([
                "payment_status" => Order::PAYMENT_SUCCESS
            ]);

            // Gửi email hóa đơn
            Mail::to($order->email)->send(new OrderInvoiceMail($order));
        } else {
            $order->update([
                "payment_status" => Order::PAYMENT_FAILED
            ]);
        }

        return redirect(route("fr.order.detail", $order->order_code));
    }

    public function detailOrder(string $orderCode, AboutAdminService $aboutAdminService, MenuService $menuService)
    {
        $order = Order::where("order_code", $orderCode)->first();

        if (!$order) {
            abort(404, 'Đơn hàng không tồn tại');
        }

        // ✅ Check user đang login có phải chủ đơn hàng không
        if ($order->user_id !== auth('frontend')->id()) {
            return redirect()->route('fr.homepage');
        }

        $menus  = $menuService->getParent();
        $abouts = $aboutAdminService->get();

        return view("frontend.order.orderDetail", [
            "order"  => $order,
            "title"  => "Chi tiết đơn hàng",
            'menus'  => $menus,
            'abouts' => $abouts
        ]);
    }
    public function myOrders(AboutAdminService $aboutAdminService, MenuService $menuService)
    {
        $user = auth('frontend')->user();
        if (!$user) {
            // Nếu chưa login, redirect về login frontend
            return redirect()->route('fr.homepage')->with('error', 'Vui lòng đăng nhập để xem đơn hàng.');
        }

        $menus  = $menuService->getParent();
        $abouts = $aboutAdminService->get();

        // Lấy tất cả đơn hàng của user, mới nhất trước
        $orders = \App\Models\Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view("frontend.order.myOrders", [
            "orders" => $orders,
            "title"  => "Danh sách đơn hàng",
            "menus"  => $menus,
            "abouts" => $abouts
        ]);
    }


    public function edit($order_code, AboutAdminService $aboutAdminService, MenuService $menuService)
    {
        $menus  = $menuService->getParent();
        $abouts = $aboutAdminService->get();
        $order = \App\Models\Order::where('order_code', $order_code)
            ->with('orderItems.product.sizes', 'orderItems.size')
            ->firstOrFail();

        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->route('fr.order.detail', $order_code)
                ->with('error', 'Đơn hàng không thể sửa lúc này!');
        }

        return view("frontend.order.orderEdit", [
            "order"  => $order,
            "title"  => "Sửa đơn hàng",
            'menus'  => $menus,
            'abouts' => $abouts
        ]);
    }

    public function update(Request $request, $order_code)
    {
        $order = \App\Models\Order::where('order_code', $order_code)
            ->with('orderItems.product.sizes', 'orderItems.size')
            ->firstOrFail();

        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->route('fr.order.detail', $order_code)
                ->with('error', 'Đơn hàng không thể sửa lúc này!');
        }

        // Validation cơ bản
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'email' => 'required|email',
            'quantities.*' => 'required|integer|min:1',
            'sizes.*' => 'required|integer',
        ]);

        // Cập nhật thông tin khách hàng
        $order->customer_name = $request->customer_name;
        $order->customer_phone = $request->customer_phone;
        $order->customer_address = $request->customer_address;
        $order->email = $request->email;
        $order->save();

        // Cập nhật số lượng và size từng sản phẩm
        foreach ($request->quantities as $itemId => $qty) {
            $orderItem = $order->orderItems->find($itemId);
            if ($orderItem && $qty > 0) {
                $orderItem->quantity = $qty;

                // Cập nhật size nếu hợp lệ
                if (isset($request->sizes[$itemId])) {
                    $newSizeId = $request->sizes[$itemId];
                    // Kiểm tra size mới có tồn tại trong sản phẩm không
                    $availableSizeIds = $orderItem->product->sizes->pluck('id')->toArray();
                    if (in_array($newSizeId, $availableSizeIds)) {
                        $orderItem->size_id = $newSizeId;
                    }
                }

                $orderItem->save();
            }
        }

        // Cập nhật tổng tiền
        $order->total_price = $order->orderItems->sum(fn($item) => $item->quantity * $item->price);
        $order->save();

        return redirect()->route('fr.order.detail', $order_code)
            ->with('success', 'Cập nhật đơn hàng thành công!');
    }

    public function cancel($order_code)
    {
        $order = \App\Models\Order::where('order_code', $order_code)->firstOrFail();

        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->route('fr.order.detail', $order_code)
                ->with('error', 'Đơn hàng không thể hủy lúc này!');
        }

        $order->status = 'canceled';
        $order->save();

        return redirect()->route('fr.order.detail', $order_code)
            ->with('success', 'Đơn hàng đã được hủy thành công!');
    }
}
