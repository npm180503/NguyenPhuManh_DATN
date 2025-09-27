<?php

namespace App\Http\Controllers\FrontEnd;

// use App\Http\Business\Cart;

use App\Http\Business\Cart as BusinessCart;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\About\AboutAdminService;
class CartController extends Controller
{
    // public function addToCart(Request $request)
    // {
    //     $cart = Cart::getInstance(auth("frontend")->id());
    //     // Sau viet vao validate
    //     $productId = $request->id;
    //     $sizeId = $request->size_id;
    //     $quantity = $request->quantity;
    //     $cart->addToCart($productId, $sizeId, $quantity);

    //     return response()->json([
    //         'cart_content' => view("frontend.cart.cart_content")->render(),
    //         'message' => 'Đã thêm vào giỏ hàng',
    //     ]);
    // }

    // // public removeCart()
    // // {
    // //     $cart = Cart::getInstance(auth("frontend")->id());
    // //     $cart->removeCart();
    // // }
    // /**
    //  * Ssau nay cai validate can move vao trong FormRequest
    //  */
    // public function updateCartItem(Request $request)
    // {
    //     $request->validate([
    //         "rowId" => ["required"],
    //         "quantity" => ["required"]
    //     ]);
    //     $cart = Cart::getInstance(auth("frontend")->id());
    //     $row = $cart->updateCart($request->get("rowId"), $request->get("quantity"));

    //     return response()->json([
    //         'message' => 'Cap nhat gio hang thanh cong',
    //         'total' => $cart->total(),
    //         'row_total' => $row->total()
    //     ]);
    // }

    // public function viewCart(MenuService $menuService)
    // {
    //     $cart = Cart::getInstance(auth("frontend")->id());
    //     $cart->refresh();
    //     $menus = $menuService->getParent();
    //     return view('frontend.cart.cartDetail', [
    //         'cart' => $cart,
    //         'title' => 'Chi tiết giỏ hàng',
    //         'menus' => $menus
    //     ]);

    // }

    // public function removeCart(Request $request)
    // {
    //     $cart = Cart::getInstance(auth("frontend")->id());
    //     $rowId = $request->rowId;
    //     $success = $cart->removeCart($rowId);
    //     return response()->json([
    //         'cart_content' => view("frontend.cart.cart_content")->render(),
    //         'success' => $success,
    //         'total' => $cart->total()
    //     ]);
    // }

    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size_id' => 'required|exists:sizes,id',
        ]);

        $user = auth('frontend')->user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $item = $cart->items()
            ->where('product_id', $productId)
            ->where('size_id', $request->size_id)
            ->first();

        if ($item) {
            $item->increment('quantity', $request->quantity);
        } else {
            $product = Product::findOrFail($productId);
            $finalPrice = $product->price_sale > 0 ? $product->price_sale : $product->price;
            $cart->items()->create([
                'product_id' => $productId,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'price' => $finalPrice,
            ]);
        }
        $cart = BusinessCart::getInstance(auth('frontend')->id());
        return response()->json([
            'message' => 'Sản phẩm đã thêm vào giỏ',
            'html' => view('components.cart-component', compact('cart'))->render(),
            // 'cart_count' => $cart->items()->count()
        ]);
    }


    public function index()
    {
        $user = auth('frontend')->user(); // lấy user đăng nhập
        $cart = Cart::where('user_id', $user->id)
            ->with('items.product') // load cả items + product
            ->first();

        return view('frontend.cart.cartDetail', compact('cart'));
    }

    // CartController
    public function headerCart()
    {
        $cartItems = [];
        $total = 0;

        if (auth('frontend')->check()) {
            $cartItems = \App\Models\CartItem::with('product', 'size')
                ->where('user_id', auth('frontend')->id())
                ->get();

            $total = $cartItems->sum(function ($item) {
                $price = $item->product->price_sale && $item->product->price_sale < $item->product->price
                    ? $item->product->price_sale
                    : $item->product->price;
                return $price * $item->quantity;
            });
        }

        return view('partials.header-cart', compact('cartItems', 'total'));
    }

    public function component()
    {
        return view('components.cart-component');
    }

    public function cartDetail(MenuService $menuService, AboutAdminService $aboutAdminService)
    {
                $menus = $menuService->getParent();
        $abouts = $aboutAdminService->get();
        $cart = Cart::where('user_id', auth('frontend')->id())
            ->with('items.product')
            ->first();

        if (!$cart) {
            return view('frontend.cart.cartDetail', [
                'title' => 'Giới thiệu',
                'menus' => $menus,
            'abouts' => $abouts,
                'cartItems' => collect(),
                'cartTotal' => 0,
            ]);
        }

        $cartItems = $cart->items;

        $cartTotal = $cartItems->sum(function ($item) {
            if (!$item->product) return 0;
            $price = $item->product->price_sale ?? $item->product->price;
            return $price * $item->quantity;
        });
        $menus = $menuService->getParent();
        $title = 'Giỏ hàng của tôi';
        return view('frontend.cart.cartDetail', compact('cartItems', 'cartTotal', 'title', 'menus'));
    }

    public function update($itemId)
    {
        $quantity = request()->get("quantity");
        $cart = Cart::where('user_id', auth('frontend')->id())->first();
        $item = CartItem::where('product_id', $itemId)->where('cart_id',  $cart->id)->first();
        if ($item) {
            $item->update([
                "quantity" => $quantity
            ]);
            $item->refresh();
            $cartTotal = $cart->items->sum(function ($cartItem) {
                return $cartItem->quantity * $cartItem->price;
            });
            return response()->json([
                'success' => true,
                'amount' => number_format($item->quantity * $item->price) . " VND",
                'total_amount' => number_format($cartTotal) . " VND",
                'message' => ''
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm trong giỏ hàng'
            ]);
        }

        return redirect()->route('cart.detail');
    }

    public function remove($itemId)
    {
        $cart = Cart::where('user_id', auth('frontend')->id())->first();
        CartItem::where('id', $itemId)->where('cart_id', $cart->id)->delete();

        // Sau khi xóa, tính lại tổng giỏ hàng
        $cartItems = CartItem::with('product', 'size')
            ->where('cart_id', $cart->id)
            ->get();

        $cartTotal = $cartItems->sum(function ($item) {
            $price = $item->product->price_sale && $item->product->price_sale < $item->product->price
                ? $item->product->price_sale
                : $item->product->price;
            return $price * $item->quantity;
        });

        $cart = BusinessCart::getInstance(auth('frontend')->id());
        return response()->json([
            'success' => true,
            'html' => view('components.cart-component', compact('cart'))->render(),
            'cart_count' => $cartItems->count(),
            'cart_total' => number_format($cartTotal),
        ]);
    }
}
