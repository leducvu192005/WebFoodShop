@extends('layouts.app')

@section('content')
<div class="fixed inset-0 bg-black bg-opacity-50 flex justify-end z-50">
    <div class="bg-white w-full sm:w-96 h-full flex flex-col">

        {{-- HEADER --}}
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-lg font-bold">Giỏ hàng của bạn</h2>
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-black text-xl">×</a>
        </div>

        {{-- CONTENT --}}
        <div class="flex-1 overflow-y-auto p-4">
           @foreach($cart as $id => $item)
    <div class="flex items-center">
        <img src="{{ asset('storage/'.$item['image']) }}" class="w-16 h-16 object-cover rounded-lg">
        <p>{{ $item['name'] }}</p>
        <span>{{ $item['quantity'] }}</span>

        {{-- Nút trừ --}}
        <form action="{{ route('cart.update', $id) }}" method="POST">
            @csrf
            <input type="hidden" name="action" value="decrease">
            <button>−</button>
        </form>

        {{-- Nút cộng --}}
        <form action="{{ route('cart.update', $id) }}" method="POST">
            @csrf
            <input type="hidden" name="action" value="increase">
            <button>+</button>
        </form>

        {{-- Xóa --}}
        <form action="{{ route('cart.remove', $id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button>×</button>
        </form>
    </div>
@endforeach

        </div>

        {{-- FOOTER --}}
        <div class="p-4 border-t">
            <div class="flex justify-between text-sm mb-2">
                <span>Tạm tính</span>
                <span>{{ number_format($subtotal) }}đ</span>
            </div>
            <div class="flex justify-between text-sm mb-4">
                <span>Phí giao hàng</span>
                <span>{{ number_format($shippingFee) }}đ</span>
            </div>

            <div class="flex justify-between font-bold text-lg mb-4">
                <span>Tổng cộng</span>
                <span>{{ number_format($subtotal + $shippingFee) }}đ</span>
            </div>

            {{-- Nút chỉ mở popup --}}
            <button onclick="document.getElementById('checkoutForm').classList.remove('hidden')" class="block w-full bg-orange-600 text-white text-center py-3 rounded">
                Đặt hàng
            </button>
        </div>

    </div>
</div>

{{-- POPUP FORM THÔNG TIN KHÁCH HÀNG --}}
<div id="checkoutForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-96">
        <h3 class="text-lg font-bold mb-3">Thông tin khách hàng</h3>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <input type="text" name="customer_name" placeholder="Họ và tên" class="w-full border p-2 mb-2" required>
            <input type="text" name="customer_phone" placeholder="Số điện thoại" class="w-full border p-2 mb-2" required>
            <input type="text" name="customer_address" placeholder="Địa chỉ giao hàng" class="w-full border p-2 mb-2" required>
            <textarea name="note" placeholder="Ghi chú (không bắt buộc)" class="w-full border p-2 mb-2"></textarea>

            <div class="flex gap-2">
                <button type="button" onclick="document.getElementById('checkoutForm').classList.add('hidden')" class="flex-1 bg-gray-300 py-2 rounded">
                    Hủy
                </button>
                <button type="submit" class="flex-1 bg-orange-600 text-white py-2 rounded">
                    Xác nhận đặt
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
