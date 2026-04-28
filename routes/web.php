<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{product:slug}', [ShopController::class, 'detail'])->name('shop-detail');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/account', [UserController::class, 'account'])->name('home');

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/increase', [CartController::class, 'increase'])->name('cart.increase');
    Route::patch('/cart/decrease', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('destroy');
    Route::delete('/cart', [CartController::class, 'destroyAll'])->name('destroy.all');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist');
    Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::delete('/wishlist', [WishlistController::class, 'destroyAll'])->name('wishlist.destroy.all');
    Route::post('/wishlist/move', [WishlistController::class, 'move'])->name('wishlist.move');
});

Route::middleware(['auth', AuthAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');

    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('coupons', CouponController::class);
});
