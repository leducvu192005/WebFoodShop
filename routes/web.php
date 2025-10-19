<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

// Trang chủ → Menu chung
Route::get('/', [UserProductController::class, 'index'])->name('home');

// Trang menu riêng
Route::get('/menu', [UserProductController::class, 'index'])->name('menu');

// Chi tiết sản phẩm
Route::get('/product/{product}', [UserProductController::class, 'show'])->name('product.show');

// Thêm sản phẩm vào giỏ
Route::post('/product/{product}/add-to-cart', [UserProductController::class, 'addToCart'])->name('cart.add');
// Hiển thị giỏ hàng
Route::get('/cart', [UserProductController::class, 'cart'])->name('cart');

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
