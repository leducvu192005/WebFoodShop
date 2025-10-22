@extends('layouts.app')
@section('content')

    
@props(['product', 'reviews'])

<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6 overflow-y-auto">
    <div class="grid md:grid-cols-2 gap-6">
        <div class="relative">
<img src="{{ asset('storage/' . $product->image) }}" 
     alt="{{ $product->name }}" 
     class="rounded-lg"
     style="width:400px; height:450px; object-fit:cover; margin:auto;">

            @if($product->discount)
                <span class="absolute top-4 left-4 bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                    -{{ $product->discount }}%
                </span>
            @endif

            @if($product->isNew)
                <span class="absolute top-4 right-4 bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded">
                    Mới
                </span>
            @endif
        </div>

        <div class="space-y-4">
            <h2 class="text-2xl font-bold">{{ $product->name }}</h2>

            <div class="flex items-center gap-2 mt-2">
                <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded">{{ $product->category }}</span>
                <div class="flex items-center gap-1">
                    ⭐ <span>{{ $product->rating }}</span>
                    <span class="text-gray-500">({{ $product->reviews }} đánh giá)</span>
                </div>
            </div>

            <p class="text-gray-500">{{ $product->description }}</p>

            <hr class="my-2">

            <div>
                <div class="flex items-baseline gap-3">
                    <span class="text-2xl text-orange-600">{{ number_format($product->price,0,',','.') }}đ</span>
                    @if($product->originalPrice)
                        <span class="text-gray-400 line-through">{{ number_format($product->originalPrice,0,',','.') }}đ</span>
                    @endif
                </div>
                @if($product->discount)
                    <p class="text-green-600 text-sm">
                        Tiết kiệm {{ number_format(($product->originalPrice ?? 0) - $product->price,0,',','.') }}đ
                    </p>
                @endif
            </div>

            <hr class="my-2">

            <div class="space-y-2">
                <label>Số lượng</label>
                <div class="flex items-center gap-3">
                    <button onclick="document.getElementById('qty').value = Math.max(1, document.getElementById('qty').value - 1)" class="px-2 py-1 border rounded">-</button>
                    <input id="qty" type="number" value="1" min="1" class="w-12 text-center border rounded">
                    <button onclick="document.getElementById('qty').value = parseInt(document.getElementById('qty').value) + 1" class="px-2 py-1 border rounded">+</button>
                </div>
            </div>

            <div class="flex gap-2 mt-2">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="quantity" id="form-qty" value="1">
                    <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded">
                        Thêm vào giỏ hàng
                    </button>
                </form>
                <button class="px-4 py-2 border rounded">Chia sẻ</button>
            </div>

            <div class="bg-gray-100 rounded-lg p-4 space-y-2 text-sm mt-2">
                <div class="flex justify-between">
                    <span class="text-gray-500">Thời gian giao hàng</span>
                    <span>20-30 phút</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Phí giao hàng</span>
                    <span>Miễn phí từ 200.000đ</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tình trạng</span>
                    <span class="text-green-600">Còn hàng</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <div class="flex border-b">
            <button onclick="showTab('desc')" class="px-4 py-2 border-b-2 border-orange-600 font-semibold" id="tab-desc-btn">Mô tả</button>
                <button onclick="showTab('reviews')" class="px-4 py-2 border-b-2 border-transparent font-semibold" id="tab-reviews-btn">
    Đánh giá ({{ count($reviews ?? []) }})
</button>


        </div>
        <div id="tab-desc" class="mt-4">
            <h4 class="mb-2 font-semibold">Thông tin chi tiết</h4>
            <p class="text-gray-500">{{ $product->description }}</p>

            <h4 class="mt-4 mb-2 font-semibold">Thành phần</h4>
            <ul class="list-disc list-inside text-gray-500 space-y-1">
                <li>Nguyên liệu tươi ngon, được chọn lọc kỹ càng</li>
                <li>Không chất bảo quản, không phẩm màu</li>
                <li>Đảm bảo vệ sinh an toàn thực phẩm</li>
            </ul>
        </div>
        <div id="tab-reviews" class="mt-4 hidden">
            @foreach($reviews as $review)
                <div class="border-b pb-4 last:border-0">
                    <div class="flex items-start gap-3">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-xl">
                            {{ $review['avatar'] }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <span>{{ $review['userName'] }}</span>
                                <span class="text-sm text-gray-500">{{ $review['date'] }}</span>
                            </div>
                            <div class="flex items-center gap-1 mb-2">
                                @for($i=0; $i<5; $i++)
                                    @if($i < $review['rating'])
                                        <span class="text-yellow-400">⭐</span>
                                    @else
                                        <span class="text-gray-300">⭐</span>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-sm text-gray-500">{{ $review['comment'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function showTab(tab) {
        document.getElementById('tab-desc').classList.add('hidden');
        document.getElementById('tab-reviews').classList.add('hidden');
        document.getElementById('tab-desc-btn').classList.remove('border-orange-600');
        document.getElementById('tab-reviews-btn').classList.remove('border-orange-600');

        if(tab === 'desc') {
            document.getElementById('tab-desc').classList.remove('hidden');
            document.getElementById('tab-desc-btn').classList.add('border-orange-600');
        } else {
            document.getElementById('tab-reviews').classList.remove('hidden');
            document.getElementById('tab-reviews-btn').classList.add('border-orange-600');
        }
    }

    document.getElementById('qty').addEventListener('input', function() {
        document.getElementById('form-qty').value = this.value;
    });
</script>
@endsection