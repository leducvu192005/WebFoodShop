<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo & Desktop Links -->
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-full bg-orange-600 flex items-center justify-center text-white">🍕</div>
                    <span class="hidden sm:inline-block text-xl font-bold text-orange-600">FoodMart</span>
                </a>

                <div class="hidden sm:flex space-x-8">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Trang chủ</x-nav-link>
                    <x-nav-link :href="route('menu')" :active="request()->routeIs('menu')">Thực đơn</x-nav-link>
                    <x-nav-link href="#">Khuyến mãi</x-nav-link>
                    <x-nav-link href="#">Về cng tôi</x-nav-link>
                </div>
            </div>

          
                <!-- User dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700">
                                {{ Auth::user()->name ?? 'Tài khoản' }}
                                <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @auth
                                <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">@csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Logout</x-dropdown-link>
                                </form>
                            @else
                                <x-dropdown-link :href="route('login')">Đăng nhập</x-dropdown-link>
                                <x-dropdown-link :href="route('register')">Đăng ký</x-dropdown-link>
                            @endauth
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="sm:hidden">
                    <button @click="open = !open" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                        <svg class="h-6 w-6">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="open ? 'block' : 'hidden'" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Trang chủ</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('menu')" :active="request()->routeIs('menu')">Thực đơn</x-responsive-nav-link>
            <x-responsive-nav-link href="#">Khuyến mãi</x-responsive-nav-link>
            <x-responsive-nav-link href="#">Về chúng tôi</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Profile</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">@csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Logout</x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">Đăng nhập</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Đăng ký</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
