<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex">

    <div class="w-64 bg-gray-800 text-white min-h-screen p-4">
        <h1 class="text-2xl font-bold mb-6">FoodMart Admin</h1>
        
        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
        <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Quản lý Sản phẩm</a>
        <a href="{{ route('admin.orders.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Quản lý Đơn hàng</a>

        @role('admin')
            <div class="mt-6 pt-3 border-t border-gray-700">
                <p class="text-xs uppercase text-gray-400 mb-2">Quản trị Hệ thống</p>
                <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Người dùng</a>
                <a href="{{ route('admin.settings') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Cấu hình</a>
            </div>
        @endrole
        
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="block py-2 px-4 w-full text-left rounded bg-red-600 hover:bg-red-700">Đăng xuất</button>
        </form>
    </div>

    <div class="flex-1 p-8">
        @yield('content')
    </div>
</body>
</html>