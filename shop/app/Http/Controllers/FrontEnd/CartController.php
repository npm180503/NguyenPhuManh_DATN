<?php

namespace App\Http\Controllers\FrontEnd;

// use App\Http\Business\Cart;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;

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

        return response()->json([
            'message' => 'Sản phẩm đã thêm vào giỏ',
            'cart_count' => $cart->items()->count()
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
    
    public function cartDetail(MenuService $menuService)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->with('items.product')
            ->first();

        if (!$cart) {
            return view('frontend.cart.cartDetail', [
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

    public function update($itemId, $action)
    {
        $item = CartItem::where('id', $itemId)->where('user_id', auth()->id())->first();

        if ($item) {
            if ($action === 'increase') {
                $item->quantity += 1;
            } elseif ($action === 'decrease' && $item->quantity > 1) {
                $item->quantity -= 1;
            }
            $item->save();
        }

        return redirect()->route('cart.detail');
    }

    public function remove($itemId)
    {
        CartItem::where('id', $itemId)->where('user_id', auth()->id())->delete();
        return redirect()->route('cart.detail');
    }
}
