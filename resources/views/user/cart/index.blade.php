@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Giỏ hàng</h2>

@if(count($cart) > 0)
    <ul>
        @foreach($cart as $item)
            <li class="mb-2">
                {{ $item['name'] }} - {{ $item['quantity'] }} x {{ number_format($item['price']) }} đ
            </li>
        @endforeach
    </ul>
@else
    <p>Giỏ hàng trống.</p>
@endif
@endsection
