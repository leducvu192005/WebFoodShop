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
use App\Http\Controllers\OrderController as UserOrderController; // 👈 alias cho order phía người dùng
use App\Http\Controllers\PromotionController; // 👈 thêm dòng này ở trên cùng

// ------------------ TRANG CHỦ & MENU ------------------
Route::get('/', [UserProductController::class, 'index'])->name('home');
Route::get('/menu', [UserProductController::class, 'index'])->name('menu');
Route::get('/', [UserProductController::class, 'home'])->name('home');

// ------------------ SẢN PHẨM ------------------
Route::get('/product/{product}', [UserProductController::class, 'show'])->name('product.show');
// khuyến mãi
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');

// ------------------ GIỎ HÀNG ------------------
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/product/{product}/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

// ------------------ THANH TOÁN (CHECKOUT) ------------------
Route::get('/checkout', [UserOrderController::class, 'checkout'])->name('checkout');   // hiển thị form điền thông tin
Route::post('/checkout/store', [UserOrderController::class, 'store'])->name('checkout.store'); // xử lý xác nhận đặt hàng
// ------------------ KHUYẾN MÃI / FLASH SALE ------------------
Route::get('/flash-sale', [UserProductController::class, 'flashSale'])->name('flash.sale');

// ------------------ SAU KHI LOGIN ------------------
Route::get('/redirect-after-login', function () {
    $user = Auth::user();
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('redirect.after.login');

// ------------------ PROFILE (KHÁCH HÀNG) ------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------ ADMIN ------------------
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
    Route::post('orders/{id}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');

        Route::resource('users', UserController::class);

        // Cài đặt
        Route::get('/settings', function () {
            $settings = \App\Models\Setting::first();
            return view('admin.settings', compact('settings'));
        })->name('settings');
        Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });

require __DIR__.'/auth.php';
