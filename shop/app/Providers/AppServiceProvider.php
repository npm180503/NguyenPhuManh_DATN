<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Services\Contact\ContactAdminService;
use App\Http\Services\Review\ReviewAdminService;
use App\Models\Order;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(ContactAdminService $contactAdminService, ReviewAdminService $reviewAdminService): void
    {
        $reviewAdminCount = $reviewAdminService->getReviewAdminCount();
        $messageCount = $contactAdminService->getMessageCount();
        $orderCount = Order::where('status', 'pending')->count();

        View::composer('*', function ($view) use ($contactAdminService, $messageCount, $reviewAdminService, $reviewAdminCount, $orderCount) {
            $view->with('messageCount', $messageCount);
            $view->with('reviewAdminCount', $reviewAdminCount);
            $view->with('orderCount', $orderCount);
        });

        View::composer('components.cart-component', function ($view) {
            $items = collect();

            if (auth('frontend')->check()) {
                $items = CartItem::with(['product', 'size'])
                    ->whereHas('cart', fn($q) => $q->where('user_id', auth('frontend')->id()))
                    ->get();
            }

            $total = $items->sum(fn($i) => (int)($i->price ?? 0) * (int)($i->quantity ?? 0));

            $view->with('cartItems', $items)
                ->with('cartTotal', $total);
        });

        Paginator::useBootstrapFive();
    }
}
