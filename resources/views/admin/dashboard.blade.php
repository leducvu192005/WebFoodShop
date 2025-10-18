@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        Chào mừng, {{ Auth::user()->name }} ({{ Auth::user()->roles->first()->name }})
    </h2>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
        <p class="text-lg">Đây là trang Dashboard của bạn.</p>
        
        @role('admin')
            <p class="mt-4 text-green-600">Bạn là Admin, có quyền truy cập đầy đủ hệ thống.</p>
        @elserole('manager')
            <p class="mt-4 text-yellow-600">Bạn là Quản lý, chỉ quản lý sản phẩm và đơn hàng của cửa hàng bạn.</p>
        @endrole
    </div>
@endsection