<?php

use App\Http\Controllers\Admin\AboutAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\InfoAdminController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FrontEnd\LoginController;
use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Controllers\Admin\MenuAdminController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\ReviewAdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginAdminController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\AboutController;
use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Controllers\FrontEnd\MainController;
use App\Http\Controllers\FrontEnd\MenuController;
use App\Http\Controllers\FrontEnd\PayController;
use App\Http\Controllers\FrontEnd\ProductController;
use App\Http\Controllers\FrontEnd\ReviewController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\FrontEnd\NewsController;
use App\Http\Controllers\FrontEnd\OrderController;
use App\Http\Controllers\Frontend\UserController;

//admin
Route::get('admin/users/login', [LoginAdminController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginAdminController::class, 'store']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [MainAdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/main', [MainAdminController::class, 'index']);

        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuAdminController::class, 'create']);
            Route::post('add', [MenuAdminController::class, 'store']);
            Route::get('list', [MenuAdminController::class, 'index']);
            Route::get('edit/{menu}', [MenuAdminController::class, 'show']);
            Route::post('edit/{menu}', [MenuAdminController::class, 'update']);
            Route::delete('destroy', [MenuAdminController::class, 'destroy']);
        });

        Route::prefix('products')->group(function () {
            Route::get('add', [ProductAdminController::class, 'create'])->name("admin.product.list");
            Route::post('add', [ProductAdminController::class, 'store']);
            Route::get('list', [ProductAdminController::class, 'index']);
            Route::get('edit/{product}', [ProductAdminController::class, 'show']);
            Route::post('edit/{product}', [ProductAdminController::class, 'update']);
            Route::delete('destroy', [ProductAdminController::class, 'destroy']);
        });

        Route::post('upload/service', [UploadController::class, 'store']);

        Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create'])->name("admin.slider.create");
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index'])->name("admin.slider.list");
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::delete('destroy', [SliderController::class, 'destroy']);
        });

        Route::prefix('abouts')->group(function () {
            Route::get('add', [AboutAdminController::class, 'create'])->name("admin.about.create");
            Route::post('add', [AboutAdminController::class, 'store']);
            Route::get('list', [AboutAdminController::class, 'index'])->name("admin.about.list");
            Route::get('edit/{about}', [AboutAdminController::class, 'show']);
            Route::post('edit/{about}', [AboutAdminController::class, 'update']);
            Route::delete('destroy', [AboutAdminController::class, 'destroy']);
        });

        Route::prefix('infos')->group(function () {
            Route::get('show', [InfoAdminController::class, 'index'])->name("admin.info");
            Route::post('edit/{info}', [InfoAdminController::class, 'update'])->name("admin.info.update");
        });

        Route::prefix('contacts')->group(function () {
            Route::get('pending', [ContactAdminController::class, 'pending'])->name("admin.contact.pending");
            Route::get('replied', [ContactAdminController::class, 'replied'])->name("admin.contact.replied");
            Route::post('mark-as-replied/{id}', [ContactAdminController::class, 'markAsReplied'])->name("admin.contact.markAsReplied");
            Route::delete('destroy', [ContactAdminController::class, 'destroy'])->name("admin.contact.destroy");
        });

        Route::prefix('reviews')->group(function () {
            Route::get('pending', [ReviewAdminController::class, 'pending'])->name("admin.review.pending");
            Route::get('replied', [ReviewAdminController::class, 'replied'])->name("admin.review.replied");
            Route::post('mark-as-replied/{id}', [ReviewAdminController::class, 'markAsReplied'])->name("admin.review.markAsReplied");
            Route::delete('destroy', [ReviewAdminController::class, 'destroy'])->name("admin.review.destroy");
        });

        Route::prefix('orders')->group(function () {
            Route::get('pending', [OrderAdminController::class, 'pending'])->name("admin.order.pending");

            Route::get('processing', [OrderAdminController::class, 'processing'])->name("admin.order.processing");
            Route::post('mark-as-processing/{id}', [OrderAdminController::class, 'markAsProcessing'])->name("admin.order.markAsProcessing");

            Route::get('shipped', [OrderAdminController::class, 'shipped'])->name("admin.order.shipped");
            Route::post('mark-as-shipped/{id}', [OrderAdminController::class, 'markAsShipped'])->name("admin.order.markAsShipped");

            Route::get('completed', [OrderAdminController::class, 'completed'])->name("admin.order.completed");
            Route::post('mark-as-completed/{id}', [OrderAdminController::class, 'markAsCompleted'])->name("admin.order.markAsCompleted");

            Route::get('canceled', [OrderAdminController::class, 'canceled'])->name("admin.order.canceled");
            Route::post('mark-as-canceled/{id}', [OrderAdminController::class, 'markAsCanceled'])->name("admin.order.markAsCanceled");

            Route::get('{id}/invoice', [OrderAdminController::class, 'invoicePdf'])->name('admin.order.invoice');
        });

        Route::prefix('new')->group(function () {
            Route::get('add', [NewsAdminController::class, 'create'])->name('admin.new.create');
            Route::post('add', [NewsAdminController::class, 'store'])->name('admin.new.store');
            Route::get('list', [NewsAdminController::class, 'index'])->name('admin.new.list');
            Route::get('edit/{id}', [NewsAdminController::class, 'edit'])->name('admin.new.edit');
            Route::post('edit/{id}', [NewsAdminController::class, 'update'])->name('admin.new.update');
            Route::delete('delete/{id}', [NewsAdminController::class, 'destroy'])->name('admin.new.delete');
        });
    });
});


//client
Route::get("/", [MainController::class, "index"])->name("fr.homepage");

Route::prefix("product")->group(function () {
    Route::get("", [ProductController::class, "index"])->name("fr.product");
    Route::get("/show-modal-detail/{id}", [ProductController::class, "showDetailInPopup"])->name("fr.product.show_modal_detail");
    Route::get("detail/{productID}", [ProductController::class, "detail"])->name("fr.product.detail");
    Route::get('/product/filter', [ProductController::class, 'filter'])->name('fr.product.filter');
});


Route::get("about", [AboutController::class, "index"])->name("fr.about");

Route::prefix('contact')->group(function () {
    Route::get("", [ContactController::class, "index"])->name("fr.contact");
    Route::post("send", [ContactController::class, "store"])->name("fr.contact.send");
});

Route::prefix('new')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('fr.new');
    Route::get('/{id}-{slug}.html', [NewsController::class, 'show'])->name('fr.new.show');
});

Route::middleware(['auth:frontend'])->group(function () {
    Route::prefix("order")->group(function () {
        Route::get("/detail/{code}", [OrderController::class, "detailOrder"])->name("fr.order.detail");
        Route::get("/momo/callback", [OrderController::class, "momoCallback"])->name("fr.order.momo.callback");
        Route::get("/my-orders", [OrderController::class, "myOrders"])->name("fr.order.list");
        Route::get('/edit/{code}', [OrderController::class, 'edit'])->name('fr.order.edit');
        Route::post('/update/{code}', [OrderController::class, 'update'])->name('fr.order.update');
        Route::post('order/cancel/{code}', [OrderController::class, 'cancel'])->name('fr.order.cancel');
    });
});

Route::middleware(['auth:frontend'])->prefix('user')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('fr.user.profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('fr.user.profile.update');
});


Route::prefix('momo')->group(function () {
    Route::get('/payment', [PayController::class, 'momo_payment'])->name('fr.momo.payment');
    Route::post('/ipn', [PayController::class, 'momoIpn'])->name('momo.ipn');
    Route::get('/return', [PayController::class, 'momoReturn'])->name('momo.return');
});

Route::get("login", [LoginController::class, "index"])->name("fr.login");
Route::post("login", [LoginController::class, "login"])->name("fr.post.login");
Route::get("register", [LoginController::class, "show"])->name("fr.register");
Route::post("register", [LoginController::class, "register"])->name("fr.post.register");
Route::post('/logout', [LoginController::class, 'logout'])->name('fr.logout');

// Route::middleware(['auth:frontend'])->group(function () {
//     Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
//     Route::post('/cart/update', [CartController::class, 'updateCartItem'])->name('cart.update');
//     Route::delete('/cart/remove', [CartController::class, 'removeCart'])->name('cart.remove');
//     Route::prefix('/cart')->group(function(){
//         Route::get("", [CartController::class, "viewCart"])->name("cart.view");
//         Route::post("/order", [OrderController::class, "store"])->name("fr.order");
//     });
//     Route::post('/review', [ReviewController::class, 'send'])->name('fr.review.send');
// });


Route::middleware(['auth:frontend'])->group(function () {
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::post('cart/update/{itemId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::prefix('/cart')->group(function () {
        Route::get("", [CartController::class, "cartDetail"])->name("cart.detail");
        Route::post("/order", [OrderController::class, "store"])->name("fr.order");
    });
    Route::get('/cart/component', [CartController::class, 'component'])->name('cart.component');
    Route::post('/review', [ReviewController::class, 'send'])->name('fr.review.send');
});
