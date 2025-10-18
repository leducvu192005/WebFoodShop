@extends('layouts.admin')

@section('content')
<h1>Danh sách đơn hàng</h1>

<form method="GET" action="{{ route('admin.orders.index') }}">
    <input type="text" name="search" value="{{ $search }}" placeholder="Tìm kiếm đơn hàng">
    <button type="submit">Tìm</button>
</form>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Khách hàng</th>
        <th>Điện thoại</th>
        <th>Email</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Hành động</th>
    </tr>
    @foreach($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->customer_name }}</td>
        <td>{{ $order->customer_phone }}</td>
        <td>{{ $order->customer_email }}</td>
        <td>{{ $order->total }}</td>
        <td>{{ $order->status }}</td>
        <td>
            <a href="{{ route('admin.orders.edit', $order->id) }}">Sửa</a>
            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $orders->links() }}
@endsection
