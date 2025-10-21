\@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-4 mt-6">

    <h2 class="text-xl font-bold mb-4 text-center">🛒 Giỏ hàng của bạn</h2>

    {{-- Nếu giỏ trống --}}
    @if($cart->isEmpty())
        <p class="text-center text-gray-500 py-8">Giỏ hàng của bạn đang trống.</p>
    @else

        {{-- Danh sách sản phẩm --}}
        <div class="divide-y">
            @foreach ($cart as $item)
                <div class="flex items-center gap-4 py-4">
                    {{-- Hình ảnh --}}
                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                         alt="{{ $item->product->name }}" 
                         class="w-20 h-20 object-cover rounded">

                    {{-- Thông tin sản phẩm --}}
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg">{{ $item->product->name }}</h3>
                        <p class="text-gray-500 text-sm">{{ number_format($item->product->price) }}đ</p>

                        {{-- Form cập nhật số lượng --}}
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2 mt-2">
                            @csrf
                            @method('PATCH')

                            <button type="button" 
                                onclick="changeQty(this, -1)" 
                                class="px-2 py-1 border rounded">-</button>

                            <input type="number" 
                                   name="quantity" 
                                   value="{{ $item->quantity }}" 
                                   min="1" 
                                   class="w-12 text-center border rounded">

                            <button type="button" 
                                onclick="changeQty(this, 1)" 
                                class="px-2 py-1 border rounded">+</button>

                            <button type="submit" 
                                    class="ml-2 text-sm text-blue-600 hover:underline">
                                Cập nhật
                            </button>
                        </form>
                    </div>

                    {{-- Xóa --}}
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Xóa</button>
                    </form>
                </div>
            @endforeach
        </div>

        {{-- FOOTER --}}
        <div class="border-t mt-4 pt-4">
            <div class="flex justify-between text-sm mb-2">
                <span>Tạm tính</span>
                <span>{{ number_format($total) }}đ</span>
            </div>
            <div class="flex justify-between text-sm mb-2">
                <span>Phí giao hàng</span>
                <span>{{ number_format($shippingFee) }}đ</span>
            </div>
            <div class="flex justify-between font-bold text-lg mb-4">
                <span>Tổng cộng</span>
                <span>{{ number_format($total + $shippingFee) }}đ</span>
            </div>

            <a href="{{ route('checkout') }}" 
               class="block w-full bg-orange-600 text-white text-center py-3 rounded hover:bg-orange-700 transition">
               Đặt hàng
            </a>
        </div>

    @endif
</div>

<script>
function changeQty(button, delta) {
    const input = button.parentElement.querySelector('input[name="quantity"]');
    let newValue = parseInt(input.value) + delta;
    if (newValue < 1) newValue = 1;
    input.value = newValue;
}
</script>
@endsection
