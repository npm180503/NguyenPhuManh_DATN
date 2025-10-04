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
use Illuminate\Support\Facades\Log;

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

    /**
     * @throws \Exception
     */
    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size_id' => 'required|exists:sizes,id',
        ]);
        try {
            $cart = \App\Http\Business\Cart::getInstance(auth("frontend")->id());
            $cart->addToCart($productId, $request->get('size_id'), $request->get('quantity'));
            return response()->json([
                'message' => 'Sản phẩm đã thêm vào giỏ',
                'html' => view('components.cart-v2-component', compact('cart'))->render(),
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi thêm vào giỏ hàng: ' . $e->getMessage());
            return response()->json([
                'message' => 'Thêm vào giỏ hàng thất bại: ' . $e->getMessage(),
            ], 400);
        }
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
        $cart = \App\Http\Business\Cart::getInstance(auth("frontend")->id());
        if (empty($cart->content())) {
            return view('frontend.cart.cartDetail', [
                'title' => 'Giới thiệu',
                'menus' => $menus,
                'abouts' => $abouts,
                'cartItems' => collect(),
                'cartTotal' => 0,
            ]);
        }
        $menus = $menuService->getParent();
        $title = 'Giỏ hàng của tôi';
        return view('frontend.cart.cart_detail', compact('cart', 'title', 'menus'));
    }

    public function update(string $itemId)
    {
        $cart = \App\Http\Business\Cart::getInstance(auth("frontend")->id());
        $quantity = request()->get("quantity");
        try {
            $item = $cart->updateCart($itemId, $quantity);
            return response()->json([
                'success' => true,
                'amount' => number_format($item->total()) . " VND",
                'total_amount' => number_format($cart->rawTotal()) . " VND",
                'message' => 'Cập nhật giỏ hàng thành công'
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật giỏ hàng: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Cập nhật giỏ hàng thất bại: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function remove($itemId)
    {
        $cart = \App\Http\Business\Cart::getInstance(auth("frontend")->id());
        $cart->removeCart($itemId);
        $cart = BusinessCart::getInstance(auth('frontend')->id());
        return response()->json([
            'success' => true,
            'html' => view('components.cart-v2-component', compact('cart'))->render()
        ]);
    }
}
