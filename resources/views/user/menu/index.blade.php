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

    <!-- Product Grid: 3 cột -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @forelse ($products as $product)
        @include('components.product-card', ['product' => $product])
    @empty
        <p class="text-center w-full">Không có món ăn nào.</p>
    @endforelse
</div>


    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $products->links() }}
    </div>
</div>
@endsection 