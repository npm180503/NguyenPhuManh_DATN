<?php

namespace App\Http\Controllers\FrontEnd;

// use App\Http\Business\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartItem;

class OrderController extends Controller
{
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

        DB::transaction(function () use ($request, $cartItems, &$order) {
            $total = 0;

            foreach ($cartItems as $item) {
                $total += $item->quantity * ($item->product->price_sale ?? $item->product->price);
            }

            $order = Order::create([
                'user_id'          => Auth::id() ?? null,
                'customer_name'    => $request->name,
                'customer_phone'   => $request->phone,
                'customer_address' => $request->address,
                'status'           => 'pending',
                'total_price'      => $total,
                'payment_method'   => $request->payment_method,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product->id,
                    'quantity'   => $item->quantity,
                    'size_id'    => $item->sizeId,
                    'price'      => $item->product->price_sale ?? $item->product->price,
                ]);
            }
        });

        // Xóa giỏ hàng
        CartItem::where('cart_id', $cart->id)->delete();
        $cart->delete();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể tạo đơn hàng'
            ], 500);
        }

        return response()->json([
            'success'        => true,
            'order_id'       => $order->id,
            'payment_method' => $order->payment_method,
        ]);
    }
}
