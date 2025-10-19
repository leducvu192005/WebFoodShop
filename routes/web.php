<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;

// Trang chủ → Menu chung
Route::get('/', [UserProductController::class, 'index'])->name('home');

// Trang menu riêng
Route::get('/menu', [UserProductController::class, 'index'])->name('menu');

// Chi tiết sản phẩm
Route::get('/product/{product}', [UserProductController::class, 'show'])->name('product.show');
// Hiển thị giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Thêm sản phẩm vào giỏ hàng
Route::post('/product/{product}/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');

// Cập nhật số lượng
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

// Xóa sản phẩm
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Đặt hàng
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

Route::post('/product/{product}/add-to-cart', [UserProductController::class, 'addToCart'])->name('cart.add');
// Hiển thị giỏ hàng
Route::get('/cart', [UserProductController::class, 'cart'])->name('cart');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

// Redirect sau login dựa theo role
Route::get('/redirect-after-login', function () {
    $user = Auth::user();
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('home');
    }
})->middleware(['auth', 'verified'])->name('redirect.after.login');

// Profile (Customer)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
        Route::resource('users', UserController::class);

        Route::get('/settings', function () {
            $settings = \App\Models\Setting::first();
            return view('admin.settings', compact('settings'));
        })->name('settings');

        Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });

require __DIR__.'/auth.php';
