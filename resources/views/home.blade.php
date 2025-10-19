@extends('layouts.navigation')

@section('content')
<div class="container mt-4">

    {{-- Tiêu đề --}}
    <div class="text-center mb-5">
        <h2 class="fw-bold">🍔 Món ăn nổi bật</h2>
        <p class="text-muted">Khám phá những món ngon được yêu thích nhất</p>
    </div>

    {{-- Danh sách món ăn --}}
    <div class="row g-4">
        @forelse ($products as $product)
            {{-- Gọi component product-card --}}
            <x-product-card :product="$product" />
        @empty
            <p class="text-center text-muted">Hiện chưa có món ăn nào.</p>
        @endforelse
    </div>
</div>
@endsection
