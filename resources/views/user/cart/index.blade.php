@extends('layouts.app')
@section('content')

{{-- FOOTER --}}
<div class="p-4 border-t">
    <div class="flex justify-between text-sm mb-2">
        <span>Tạm tính</span>
        <span>{{ number_format($total) }}đ</span>
    </div>
    <div class="flex justify-between text-sm mb-4">
        <span>Phí giao hàng</span>
        <span>{{ number_format($shippingFee) }}đ</span>
    </div>
    <div class="flex justify-between font-bold text-lg mb-4">
        <span>Tổng cộng</span>
        <span>{{ number_format($total + $shippingFee) }}đ</span>
    </div>

    {{-- Nút chuyển sang trang checkout --}}
    <a href="{{ route('checkout') }}" 
       class="block w-full bg-orange-600 text-white text-center py-3 rounded hover:bg-orange-700 transition">
       Đặt hàng
    </a>
</div>
@endsection