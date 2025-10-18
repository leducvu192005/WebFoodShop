<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ===============================
    // Danh sách người dùng
    // ===============================
    public function index()
    {
        $users = User::paginate(10); // Lấy danh sách user phân trang 10 bản ghi
        return view('admin.users.index', compact('users'));
    }

    // ===============================
    // Form tạo người dùng mới
    // ===============================
    public function create()
    {
        return view('admin.users.create');
    }

    // ===============================
    // Lưu người dùng mới
    // ===============================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Thêm người dùng thành công!');
    }

    // ===============================
    // Form chỉnh sửa người dùng
    // ===============================
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // ===============================
    // Cập nhật người dùng
    // ===============================
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string',
        ]);

        // Nếu nhập password mới thì hash, nếu không giữ nguyên
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    // ===============================
    // Xóa người dùng
    // ===============================
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Đã xóa người dùng!');
    }
}
