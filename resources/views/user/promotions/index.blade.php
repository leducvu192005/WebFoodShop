@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="fw-bold mb-4 text-center text-danger">
        🔥 ƯU ĐÃI ĐẶC BIỆT - FLASH SALE 🔥
    </h3>

    {{-- Thanh chứa thẻ khuyến mãi --}}
    <div class="flash-sale-container d-flex gap-4 overflow-auto pb-3 px-2">
        @forelse ($products as $product)
            <div class="flash-sale-card flex-shrink-0 bg-white border-0 shadow-sm rounded-4 position-relative"
                 style="width: 230px; cursor: pointer;"
                 onclick="window.location='{{ route('product.show', $product->id) }}'">

                {{-- Hình ảnh --}}
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid w-100 rounded-top-4"
                         style="height: 180px; object-fit: cover; border-top-left-radius: 16px; border-top-right-radius: 16px;">
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1 fs-6 shadow-sm">
                        -{{ $product->discount }}%
                    </span>
                </div>

                {{-- Nội dung --}}
                <div class="card-body text-center py-3">
                    <h6 class="fw-semibold text-truncate mb-2" title="{{ $product->name }}">
                        {{ $product->name }}
                    </h6>

                    {{-- Giá gốc và giá sau giảm --}}
                    <div class="d-flex flex-column align-items-center">
                        <div class="text-muted small">
                            <span class="fw-semibold">Giá gốc:</span>
                            <span class="text-decoration-line-through">
                                {{ number_format($product->price, 0, ',', '.') }}đ
                            </span>
                        </div>
                        <div class="text-danger fw-bold fs-5 mt-1">
                            Giá KM: {{ number_format($product->price * (1 - $product->discount / 100), 0, ',', '.') }}đ
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted w-100">Hiện không có món nào đang khuyến mãi.</p>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
.flash-sale-container {
  display: flex;
  overflow-x: auto;
  scroll-behavior: smooth;
  scrollbar-width: thin;
}

.flash-sale-container::-webkit-scrollbar {
  height: 6px;
}
.flash-sale-container::-webkit-scrollbar-thumb {
  background: #ff6b6b;
  border-radius: 4px;
}

.flash-sale-card {
  border-radius: 16px; /* 👈 Bo góc toàn thẻ */
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.flash-sale-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
}
</style>
@endpush
