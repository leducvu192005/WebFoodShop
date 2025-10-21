@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4 text-center">Thông tin đặt hàng</h2>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block mb-1 font-semibold">Họ và tên</label>
            <input type="text" name="customer_name" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-semibold">Số điện thoại</label>
            <input type="text" name="customer_phone" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-semibold">Địa chỉ giao hàng</label>
            <input type="text" name="customer_address" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-semibold">Ghi chú (tuỳ chọn)</label>
            <textarea name="note" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="border-t pt-3 mt-4 text-sm">
            <div class="flex justify-between">
                <span>Tạm tính</span>
                <span>{{ number_format($subtotal) }}đ</span>
            </div>
            <div class="flex justify-between">
                <span>Phí giao hàng</span>
                <span>{{ number_format($shippingFee) }}đ</span>
            </div>
            <div class="flex justify-between font-bold text-lg mt-2">
                <span>Tổng cộng</span>
                <span>{{ number_format($subtotal + $shippingFee) }}đ</span>
            </div>
        </div>

        <button type="submit" class="mt-5 w-full bg-orange-600 text-white py-3 rounded hover:bg-orange-700 transition">
            Xác nhận đặt hàng
        </button>
    </form>
</div>
@endsection
