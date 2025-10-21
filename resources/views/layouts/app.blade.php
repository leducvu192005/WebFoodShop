<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodMart')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900">

<header class="sticky top-0 z-50 w-full border-b bg-white backdrop-blur supports-[backdrop-filter]:bg-white/60">
    <div class="container mx-auto flex h-16 items-center justify-between px-4">

        {{-- Logo --}}
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-full bg-black flex items-center justify-center text-white">
                    🍕
                </div>
                <span class="hidden sm:inline-block text-lg font-medium">FoodMart</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="hidden lg:flex items-center gap-6">
            <a href="{{ route('home') }}" class="text-sm hover:text-orange-600 transition-colors">Trang chủ</a>
            <a href="{{ route('menu') }}" class="text-sm hover:text-orange-600 transition-colors">Thực đơn</a>
            <a href="#" class="text-sm hover:text-orange-600 transition-colors">Khuyến mãi</a>
            <a href="#" class="text-sm hover:text-orange-600 transition-colors">Về chúng tôi</a>
        </nav>

        {{-- Search + User + Cart --}}
        <div class="flex items-center gap-4">

            {{-- Thanh tìm kiếm --}}
            <form action="{{ route('menu') }}" method="GET" class="hidden md:flex items-center bg-gray-100 rounded-lg px-3 py-2 w-64">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Tìm kiếm món ăn..." class="bg-transparent outline-none text-sm w-full" value="{{ request('search') }}">
            </form>

            {{-- User Dropdown --}}
            <div x-data="{ open: false }" class="relative">
                @auth
                    <button @click="open = !open" class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 hover:bg-gray-300 transition">
                        <!-- Icon người -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A9 9 0 1118.878 6.195a9 9 0 01-13.757 11.61z" />
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="open" @click.away="open = false" 
                         class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50">
                        <div class="px-4 py-2 text-sm text-gray-700">Xin chào, {{ Auth::user()->name }}</div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Hồ sơ
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                @else
                    {{-- Nếu chưa đăng nhập --}}
                    <div class="flex gap-2">
                        <a href="{{ route('login') }}" class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 hover:bg-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5.121 17.804A9 9 0 1118.878 6.195a9 9 0 01-13.757 11.61z" />
                            </svg>
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 hover:bg-gray-300 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4" />
                            </svg>
                        </a>
                    </div>
                @endauth
            </div>

            {{-- Cart Icon --}}
            <a href="{{ route('cart.index') }}" class="hover:text-orange-600 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7h11L17 13M7 13l4 8m0 0a1 1 0 001 1h6a1 1 0 001-1m-8-8h8" />
                </svg>
                {{-- Hiển thị số lượng sản phẩm trong session --}}
                <span class="absolute -top-2 -right-2 bg-orange-600 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                    {{ count(session('cart', [])) }}
                </span>
            </a>
        </div>
    </div>
</header>

<main class="container mx-auto py-6">
    @yield('content')
</main>
@include('layouts.footer')

</body>
</html>
