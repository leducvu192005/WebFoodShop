<footer class="bg-muted border-t mt-16">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- About --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-primary-foreground">
                        🍕
                    </div>
                    <span>FoodMart</span>
                </div>
                <p class="text-sm text-muted-foreground mb-4">
                    Nền tảng đặt đồ ăn trực tuyến hàng đầu Việt Nam. Giao hàng nhanh, món ngon mỗi ngày.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="h-9 w-9 rounded-full bg-background flex items-center justify-center hover:bg-primary hover:text-primary-foreground transition-colors">
                        <x-lucide-facebook class="h-4 w-4" />
                    </a>
                    <a href="#" class="h-9 w-9 rounded-full bg-background flex items-center justify-center hover:bg-primary hover:text-primary-foreground transition-colors">
                        <x-lucide-instagram class="h-4 w-4" />
                    </a>
                    <a href="#" class="h-9 w-9 rounded-full bg-background flex items-center justify-center hover:bg-primary hover:text-primary-foreground transition-colors">
                        <x-lucide-twitter class="h-4 w-4" />
                    </a>
                    <a href="#" class="h-9 w-9 rounded-full bg-background flex items-center justify-center hover:bg-primary hover:text-primary-foreground transition-colors">
                        <x-lucide-youtube class="h-4 w-4" />
                    </a>
                </div>
            </div>

            {{-- Company --}}
            <div>
                <h4 class="mb-4">Công ty</h4>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li><a href="{{ route('about') }}" class="hover:text-foreground transition-colors">Về chúng tôi</a></li>
                    <li><a href="{{ route('jobs') }}" class="hover:text-foreground transition-colors">Tuyển dụng</a></li>
                    <li><a href="{{ route('partners') }}" class="hover:text-foreground transition-colors">Đối tác</a></li>
                    <li><a href="{{ route('news') }}" class="hover:text-foreground transition-colors">Tin tức</a></li>
                </ul>
            </div>

            {{-- Support --}}
            <div>
                <h4 class="mb-4">Hỗ trợ</h4>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li><a href="{{ route('help') }}" class="hover:text-foreground transition-colors">Trung tâm trợ giúp</a></li>
                    <li><a href="{{ route('shipping.policy') }}" class="hover:text-foreground transition-colors">Chính sách giao hàng</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-foreground transition-colors">Điều khoản sử dụng</a></li>
                    <li><a href="{{ route('privacy') }}" class="hover:text-foreground transition-colors">Chính sách bảo mật</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="mb-4">Liên hệ</h4>
                <ul class="space-y-2 text-sm text-muted-foreground">
                    <li>Hotline: 1900 1234</li>
                    <li>Email: support@foodmart.vn</li>
                    <li>Địa chỉ: 123 Đường ABC, Quận 1, TP.HCM</li>
                    <li>Thời gian: 8:00 - 22:00 hàng ngày</li>
                </ul>
            </div>

        </div>

        <div class="border-t mt-8 pt-8 text-center text-sm text-muted-foreground">
            <p>&copy; 2025 FoodMart. Tất cả quyền được bảo lưu.</p>
        </div>
    </div>
</footer>
