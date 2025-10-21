@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- Tiêu đề --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold text-danger">🔥 Flash Sale - Giảm giá sốc!</h2>
        <p class="text-muted">Nhanh tay săn ngay những món ăn đang được giảm giá</p>
    </div>

    {{-- Danh sách sản phẩm giảm giá --}}
    <div class="row g-4">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <p class="text-center text-muted">Hiện chưa có món ăn nào đang giảm giá.</p>
        @endforelse
    </div>
</div>
@endsection
