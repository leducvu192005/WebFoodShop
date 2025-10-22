@props(['product'])

<div class="group bg-white rounded-lg overflow-hidden border shadow-sm hover:shadow-md transition-all duration-300"
     style="width: 400px;
     height: 450px;

      font-size: 10px;">

    <div class="relative w-full flex-shrink-0 bg-gray-100"
     style="height:65%; cursor:pointer; background-image:url('{{ asset('storage/' . $product->image) }}'); background-size:contain; background-position:center; background-repeat:no-repeat;"
     onclick="window.location='{{ route('product.show', $product->id) }}'">

    @if($product->discount)
        <span class="absolute top-0 left-0 bg-red-500 text-white px-1 rounded text-[8px]">
            -{{ $product->discount }}%
        </span>
    @endif

    @if($product->isNew)
        <span class="absolute top-0 right-0 bg-green-500 text-white px-1 rounded text-[8px]">
            Mới
        </span>
    @endif

</div>

    <div class="p-1 flex flex-col justify-end flex-1" style="height:35%;">
        <div class="flex justify-between items-center">
            <span class="text-gray-500 truncate">{{ $product->category }}</span>
            <span class="text-yellow-400">⭐{{ $product->rating }}</span>
        </div>

        <h3 class="truncate font-bold" title="{{ $product->name }}">
            {{ $product->name }}
        </h3>

        <div class="flex justify-between items-center">
            <span class="text-orange-600 font-bold">{{ number_format($product->price,0,',','.') }}đ</span>
            @if($product->originalPrice)
                <span class="line-through text-gray-400 text-[8px]">
                    {{ number_format($product->originalPrice,0,',','.') }}đ
                </span>
            @endif
        </div>

        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-orange-600 text-white text-[10px] w-full rounded mt-1">
                +
            </button>
        </form>
    </div>
</div>  