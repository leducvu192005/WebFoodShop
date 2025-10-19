<header class="sticky top-0 z-50 w-full border-b bg-white backdrop-blur supports-[backdrop-filter]:bg-white/60">
    <div class="container mx-auto flex h-16 items-center justify-between px-4">
        {{-- Logo --}}
        <div class="flex items-center gap-6">
            <a href="/" class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-full bg-black flex items-center justify-center text-white">
                    🍕
                </div>
                <span class="hidden sm:inline-block text-lg font-medium">FoodMart</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="hidden lg:flex items-center gap-6">
            <a href="#" class="text-sm hover:text-orange-600 transition-colors">Trang chủ</a>
            <a href="#" class="text-sm hover:text-orange-600 transition-colors">Thực đơn</a>
            <a href="#" class="text-sm hover:text-orange-600 transition-colors">Khuyến mãi</a>
            <a href="#" class="text-sm hover:text-orange-600 transition-colors">Về chúng tôi</a>
        </nav>

        {{-- Search + Icons --}}
        <div class="flex items-center gap-4">
            <div class="hidden md:flex items-center bg-gray-100 rounded-lg px-3 py-2 w-64">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Tìm kiếm món ăn..." class="bg-transparent outline-none text-sm w-full">
            </div>

            {{-- User Icon --}}
            <a href="#" class="hover:text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A9 9 0 1118.878 6.195a9 9 0 01-13.757 11.61z" />
                </svg>
            </a>

            {{-- Cart Icon --}}
            <a href="#" class="hover:text-orange-600 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7h11L17 13M7 13l4 8m0 0a1 1 0 001 1h6a1 1 0 001-1m-8-8h8" />
                </svg>
                {{-- Số lượng sản phẩm --}}
                <span class="absolute -top-2 -right-2 bg-orange-600 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                    2
                </span>
            </a>
        </div>
    </div>
</header>
