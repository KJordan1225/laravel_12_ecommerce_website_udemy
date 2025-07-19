<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserController as FrontendUserController;
use App\Http\Controllers\OrderController as FrontendOrderController;
use App\Http\Controllers\ProductController as FrontendProductController;
use App\Http\Controllers\ReviewController as FrontendReviewController;

/*****admin guest routes*******/
Route::middleware('admin.guest')->group(function() {
    Route::get('admin/login', [AdminController::class,'login'])->name('admin.login');
    Route::post('admin/auth', [AdminController::class,'auth'])->name('admin.auth');
});


/*****admin auth routes*******/
Route::middleware('admin')->prefix('admin')->group(function() {
    Route::get('dashboard', [AdminController::class,'index'])->name('admin.index');
    Route::post('admin/logout', [AdminController::class,'logout'])->name('admin.logout');
    //category routes
    Route::resource('categories', CategoryController::class, [
        'names' => [
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]
    ]);
    //subcategory routes
    Route::resource('subcategories', SubcategoryController::class, [
        'names' => [
            'index' => 'admin.subcategories.index',
            'create' => 'admin.subcategories.create',
            'store' => 'admin.subcategories.store',
            'edit' => 'admin.subcategories.edit',
            'update' => 'admin.subcategories.update',
            'destroy' => 'admin.subcategories.destroy',
        ]
    ]);
    //childcategory routes
    Route::resource('childcategories', ChildcategoryController::class, [
        'names' => [
            'index' => 'admin.childcategories.index',
            'create' => 'admin.childcategories.create',
            'store' => 'admin.childcategories.store',
            'edit' => 'admin.childcategories.edit',
            'update' => 'admin.childcategories.update',
            'destroy' => 'admin.childcategories.destroy',
        ]
    ]);
    //brand routes
    Route::resource('brands', BrandController::class, [
        'names' => [
            'index' => 'admin.brands.index',
            'create' => 'admin.brands.create',
            'store' => 'admin.brands.store',
            'edit' => 'admin.brands.edit',
            'update' => 'admin.brands.update',
            'destroy' => 'admin.brands.destroy',
        ]
    ]);
    //color routes
    Route::resource('colors', ColorController::class, [
        'names' => [
            'index' => 'admin.colors.index',
            'create' => 'admin.colors.create',
            'store' => 'admin.colors.store',
            'edit' => 'admin.colors.edit',
            'update' => 'admin.colors.update',
            'destroy' => 'admin.colors.destroy',
        ]
    ]);
    //size routes
    Route::resource('sizes', SizeController::class, [
        'names' => [
            'index' => 'admin.sizes.index',
            'create' => 'admin.sizes.create',
            'store' => 'admin.sizes.store',
            'edit' => 'admin.sizes.edit',
            'update' => 'admin.sizes.update',
            'destroy' => 'admin.sizes.destroy',
        ]
    ]);
    //product routes
    Route::resource('products', ProductController::class, [
        'names' => [
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]
    ]);
    //coupon routes
    Route::resource('coupons', CouponController::class, [
        'names' => [
            'index' => 'admin.coupons.index',
            'create' => 'admin.coupons.create',
            'store' => 'admin.coupons.store',
            'edit' => 'admin.coupons.edit',
            'update' => 'admin.coupons.update',
            'destroy' => 'admin.coupons.destroy',
        ]
    ]);
    //order routes
    Route::get('orders', [OrderController::class,'index'])->name('admin.orders.index');
    Route::get('update/{order}/orders', [OrderController::class,'updateDeliveredAtDate'])->name('admin.orders.update');
    Route::delete('delete/{order}/orders', [OrderController::class,'destroy'])->name('admin.orders.destroy');
    //review routes
    Route::get('reviews', [ReviewController::class,'index'])->name('admin.reviews.index');
    Route::get('update/{review}/{status}/review', [ReviewController::class,'updateReviewStatus'])->name('admin.reviews.update');
    Route::delete('delete/{review}/reviews', [ReviewController::class,'destroy'])->name('admin.reviews.destroy');
    //user routes
    Route::get('users', [UserController::class,'index'])->name('admin.users.index');
    Route::delete('delete/{user}/users', [UserController::class,'destroy'])->name('admin.users.destroy');
});

/*****user guest routes*******/
//home page route
Route::get('/', [FrontendProductController::class,'index'])->name('home');
//order products route
Route::get('order/products', [FrontendProductController::class,'orderProducts'])->name('order.products');
//filter products routes
Route::get('show/{product}/product', [FrontendProductController::class,'show'])->name('products.show');
Route::get('subcategory/{subcategory}/products', [FrontendProductController::class,'productsBySubcategory'])->name('subcategory.products');
Route::get('childcategory/{childcategory}/products', [FrontendProductController::class,'productsByChildcategory'])->name('childcategory.products');
Route::get('brand/{brand}/products', [FrontendProductController::class,'productsByBrand'])->name('brand.products');
Route::get('color/{color}/products', [FrontendProductController::class,'productsByColor'])->name('color.products');
Route::get('size/{size}/products', [FrontendProductController::class,'productsBySize'])->name('size.products');
//search for products
Route::get('search/products', [FrontendProductController::class,'searchProducts'])->name('search.products');
//cart routes
Route::post('add/cart', [CartController::class,'addToCart'])->name('cart.add');
Route::get('cart', [CartController::class,'index'])->name('cart.index');
Route::post('update/cart', [CartController::class,'updateCartItem'])->name('cart.update');
Route::post('remove/cart', [CartController::class,'removeCartItem'])->name('cart.remove');
Route::post('clear/cart', [CartController::class,'clearCart'])->name('cart.clear');

Route::middleware('guest')->group(function() {
    Route::get('user/register', [FrontendUserController::class,'showRegisterForm'])->name('user.register');
    Route::post('user/store', [FrontendUserController::class,'store'])->name('user.store');
    Route::get('user/login', [FrontendUserController::class,'showLoginForm'])->name('login');
    Route::post('user/auth', [FrontendUserController::class,'auth'])->name('user.auth');
});

/*****user auth routes*******/
Route::middleware('auth')->group(function() {
    //user routes
    Route::post('user/logout', [FrontendUserController::class,'logout'])->name('user.logout');
    Route::get('user/profile', [FrontendUserController::class,'showProfilePage'])->name('user.profile');
    Route::put('update/profile/image', [FrontendUserController::class,'updateUserProfileImage'])->name('profile.image');
    Route::put('update/user/data', [FrontendUserController::class,'updateUserData'])->name('user.data');
    Route::get('user/orders', [FrontendUserController::class,'showUserOrdersPage'])->name('user.orders');
    //checkout routes
    Route::get('checkout', [CheckoutController::class,'index'])->name('checkout.index');
    //coupon routes
    Route::post('apply/coupon', [CheckoutController::class,'applyCoupon'])->name('apply.coupon');
    Route::get('remove/coupon', [CheckoutController::class,'removeCoupon'])->name('remove.coupon');
    //order routes
    Route::get('order/pay', [FrontendOrderController::class,'payOrderByStripe'])->name('order.pay');
    Route::get('success/pay', [FrontendOrderController::class,'successPaid'])->name('order.success');
    //review routes
    Route::post('review/store', [FrontendReviewController::class,'store'])->name('review.store');
});

// Route::get('/phpinfo', function () {
//     phpinfo();
// });
