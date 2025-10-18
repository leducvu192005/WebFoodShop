<header class="sticky top-0 z-50 w-full border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
    <div class="container mx-auto flex h-16 items-center justify-between px-4">

        {{-- Logo --}}
        <div class="flex items-center gap-6">
            <button class="lg:hidden">
                {{-- Icon Menu (bạn có thể dùng Heroicons hoặc Lucide) --}}
                <x-lucide-menu class="h-6 w-6" />
            </button>

            <a href="/" class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-primary-foreground">
                    🍕
                </div>
                <span class="hidden sm:inline-block">FoodMart</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="hidden lg:flex items-center gap-6">
            <a href="{{ url('/') }}" class="text-sm hover:text-primary transition-colors">
                Trang chủ
            </a>
            <a href="{{ route('menu.index') }}" class="text-sm hover:text-primary transition-colors">
                Thực đơn
            </a>
            <a href="{{ route('promotions.index') }}" class="text-sm hover:text-primary transition-colors">
                Khuyến mãi
            </a>
            <a href="{{ route('about') }}" class="text-sm hover:text-primary transition-colors">
                Về chúng tôi
            </a>
        </nav>

        {{-- Search & Actions --}}
        <div class="flex items-center gap-2">
            {{-- Ô tìm kiếm --}}
            <form action="{{ route('search') }}" method="GET" class="hidden md:flex items-center gap-2 bg-muted rounded-lg px-3 py-2 w-64 hover:bg-muted/80 transition-colors">
                <x-lucide-search class="h-4 w-4 text-muted-foreground" />
                <input 
                    type="text" 
                    name="q" 
                    placeholder="Tìm kiếm món ăn..." 
                    class="bg-transparent outline-none text-sm text-muted-foreground w-full"
                />
            </form>

            {{-- Search icon cho mobile --}}
            <button class="md:hidden">
                <x-lucide-search class="h-5 w-5" />
            </button>

            {{-- Auth --}}
            @auth
                <a href="{{ route('profile') }}" class="h-8 w-8 rounded-full bg-orange-600 text-white flex items-center justify-center">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </a>
            @else
                <a href="{{ route('login') }}">
                    <x-lucide-user class="h-5 w-5" />
                </a>
            @endauth

            {{-- Giỏ hàng --}}
            <a href="{{ route('cart.index') }}" class="relative">
                <x-lucide-shopping-cart class="h-5 w-5" />
                @php
                    $cartCount = session('cart') ? count(session('cart')) : 0;
                @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-primary text-primary-foreground text-xs flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</header>
