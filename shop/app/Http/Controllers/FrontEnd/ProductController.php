<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Business\Cart;
use App\Http\Controllers\Controller;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Http\Services\Review\ReviewService;
use App\Models\Product;

class ProductController extends Controller
{
    protected $reviewService;
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }
    public function index(MenuService $menuService, ProductService $productService, Request $request)
    {
        $menus = $menuService->getParentWithChildren(); // Lấy cha + con

        $menuId = $request->query('menu_id');
        $filter = $request->query('filter');

        if ($menuId) {
            // Lấy tất cả menu con nếu menuId là danh mục cha
            $childMenuIds = $menuService->getChildMenuIds($menuId);
            $childMenuIds[] = $menuId; // Bao gồm cả menu cha
            $products = $productService->getByMenus($childMenuIds);
        } else {
            $products = $productService->getAll();
        }

        return view('frontend.product.product', [
            'title' => 'Sản phẩm',
            'menus' => $menus,
            'products' => $products
        ]);
    }


    public function detail(MenuService $menuService, int $productID)
    {
        $menus = $menuService->getParent();
        $sizes = Size::all();
        $product = resolve(ProductService::class)->show($productID, ["menu"]);
        $product->loadCount("reviews");
        $product->load(["sizes", "reviews"]);

        // Lấy danh mục con của sản phẩm
        $category = Menu::find($product->menu_id);

        // Kiểm tra danh mục cha của nó
        $parentCategory = $category ? Menu::find($category->parent_id) : null;

        // Kiểm tra danh mục cha cấp cao nhất
        $rootCategory = $parentCategory ? Menu::find($parentCategory->parent_id) : null;

        // 🔥 Lấy sản phẩm liên quan (cùng danh mục, khác ID hiện tại)
        $relatedProducts = Product::where('menu_id', $product->menu_id)
            ->where('id', '!=', $product->id)
            ->take(4) // số sản phẩm liên quan hiển thị
            ->get();

        return view('frontend.product.productDetail', [
            "id" => $productID,
            'title' => 'Chi tiết sản phẩm',
            'menus' => $menus,
            "category" => $category,
            "parentCategory" => $parentCategory,
            "rootCategory" => $rootCategory,
            "sizes" => $sizes,
            "product" => $product,
            "availableSizes" => $product->sizes->pluck("id")->toArray(),
            "reviewCount" => (int) $product->reviews_count,
            "relatedProducts" => $relatedProducts, // 👈 truyền sang view
        ]);
    }


    public function showDetailInPopup(int $productID)
    {
        $sizes = Size::all();
        $product = resolve(ProductService::class)->show($productID, ["menu"]);
        $product->load("sizes");
        return response()->json([
            "id" => $productID,
            "content" => view("frontend.product.includes.product_in_popup", [
                "sizes" => $sizes,
                "product" => $product,
                "availableSizes" => $product->sizes->pluck("id")->toArray()
            ])->render()
        ]);
    }

    public function filter(Request $request)
    {
        $query = Product::query();
        $menuId = $request->input('menu_id', 'all');
        $search = $request->input('search', '');
        $filter = $request->input('filter', '');
        $priceRange = $request->input('price_range', 'all'); // Thêm dòng này

        if ($menuId === "sale") {
            $query->where('price_sale', '>', 0);
        } elseif ($menuId !== "all") {
            $menuIds = Menu::where('parent_id', $menuId)->pluck('id')->toArray();
            $menuIds[] = $menuId;
            $query->whereIn('menu_id', $menuIds);
        }

        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        // Lọc theo khoảng giá
        if (!empty($priceRange) && $priceRange !== 'all') {
            switch ($priceRange) {
                case '0-499000':
                    $query->where(function ($q) {
                        $q->whereBetween('price_sale', [0, 499000])
                            ->orWhere(function ($q2) {
                                $q2->whereNull('price_sale')->whereBetween('price', [0, 499000]);
                            });
                    });
                    break;
                case '500000-999000':
                    $query->where(function ($q) {
                        $q->whereBetween('price_sale', [500000, 999000])
                            ->orWhere(function ($q2) {
                                $q2->whereNull('price_sale')->whereBetween('price', [500000, 999000]);
                            });
                    });
                    break;
                case '1000000-2999000':
                    $query->where(function ($q) {
                        $q->whereBetween('price_sale', [1000000, 2999000])
                            ->orWhere(function ($q2) {
                                $q2->whereNull('price_sale')->whereBetween('price', [1000000, 2999000]);
                            });
                    });
                    break;
                case '3000000+':
                    $query->where(function ($q) {
                        $q->where('price_sale', '>', 3000000)
                            ->orWhere(function ($q2) {
                                $q2->whereNull('price_sale')->where('price', '>', 3000000);
                            });
                    });
                    break;
            }
        }


        // Sắp xếp dữ liệu
        if (!empty($filter)) {
            if ($filter === "price-low") {
                $query->orderByRaw("CASE WHEN price_sale > 0 THEN price_sale ELSE price END ASC");
            } elseif ($filter === "price-high") {
                $query->orderByRaw("CASE WHEN price_sale > 0 THEN price_sale ELSE price END DESC");
            } elseif ($filter === "newest") {
                $query->orderBy('created_at', 'desc');
            }
        }


        $products = $query->get();

        return response()->json([
            'html' => view('frontend.product.list', compact('products'))->render(),
        ]);
    }
}
