<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    $user = auth()->user();

    // Chuyển hướng theo vai trò
    if ($user->hasRole('admin') || $user->hasRole('manager')) {
        return redirect()->route('admin.dashboard');
    }

    // Người dùng bình thường
    return redirect()->route('home');
}


    /**
     * Destroy an authenticated session.
     */
  
    public function destroy(Request $request): RedirectResponse
{
    $user = Auth::user(); // lấy thông tin user trước khi logout

    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // ✅ Nếu là admin hoặc manager thì về form đăng nhập
    if ($user && ($user->hasRole('admin') || $user->hasRole('manager'))) {
        return redirect('/login');
    }

    // ✅ Người dùng bình thường về trang chủ
    return redirect('/');
}

}
