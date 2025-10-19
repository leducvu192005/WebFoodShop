@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- Category Filter -->
    <div class="mb-6 flex justify-center flex-wrap gap-4">
        @php
            $categories = ['all', 'Bánh mì', 'Pizza', 'Mỳ Ý', 'Trà sữa', 'Fastfood']; // ví dụ
        @endphp
        @foreach($categories as $cat)
            <a href="{{ route('menu', ['category' => $cat]) }}"
               class="px-4 py-2 rounded-full border
                      {{ ($category ?? 'all') === $cat 
                         ? 'bg-orange-600 text-white border-orange-600' 
                         : 'bg-gray-100 text-gray-700 border-gray-300 hover:bg-gray-200' }}">
                {{ ucfirst($cat) }}
            </a>
        @endforeach
    </div>
<!-- Thay thế đoạn grid bằng đoạn này -->
<div class="flex flex-wrap">
    @foreach ($products as $product)
        <div class="w-1/3 p-2"> {{-- 3 cột mỗi hàng --}}
            @include('components.product-card', ['product' => $product])
        </div>
    @endforeach
</div>





    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $products->links() }}
    </div>
</div>
@endsection 