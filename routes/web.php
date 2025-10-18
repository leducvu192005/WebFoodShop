<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import Controllers cho Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| KHU VỰC KHÁCH HÀNG (CUSTOMER) & KHÁCH CHƯA ĐĂNG NHẬP
|--------------------------------------------------------------------------
*/

// Trang chủ — ai cũng vào được
Route::get('/', function () {
    return view('home');
})->name('home');

// Khi đăng nhập thành công → tự động chuyển theo role
Route::get('/redirect-after-login', function () {
    $user = Auth::user();
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('home');
    }
})->middleware(['auth', 'verified'])->name('redirect.after.login');

// Hồ sơ người dùng (Customer)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| KHU VỰC QUẢN TRỊ (CHỈ DÀNH CHO ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('settings');
    });

require __DIR__.'/auth.php';
