<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import Controllers cho Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| KHU VỰC KHÁCH HÀNG (CUSTOMER) & KHÁCH CHƯA ĐĂNG NHẬP
|--------------------------------------------------------------------------
*/

// Trang chủ — ai cũng vào được
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/product/{product}', [UserProductController::class, 'show'])->name('product.show');

Route::post('/product/{product}/add-to-cart', [UserProductController::class, 'add'])->name('cart.add');


Route::get('/', [UserProductController::class, 'index'])->name('menu');
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
       Route::resource('users', UserController::class);

         // Trang settings
    Route::get('/settings', function () {
        $settings = \App\Models\Setting::first();
        return view('admin.settings', compact('settings'));
    })->name('settings');

    // Route update để lưu settings
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });

require __DIR__.'/auth.php';
