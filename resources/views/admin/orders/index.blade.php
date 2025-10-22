@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">📦 Quản lý đơn hàng</h1>

    <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-3">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="🔍 Tìm theo tên, email hoặc ID đơn hàng" style="padding:6px; width:250px;">
        <button type="submit" style="padding:6px 10px;">Tìm kiếm</button>
    </form>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="6" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <thead style="background:#f8f9fa;">
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Điện thoại</th>
                <th>Email</th>
                <th>Tổng tiền (₫)</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ $order->customer_email }}</td>
                    <td>{{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>
                        @if($order->status == 'pending')
                            <span style="color:orange;">Chờ xử lý</span>
                        @elseif($order->status == 'delivered')
                            <span style="color:green;">Đã giao</span>
                        @elseif($order->status == 'cancelled')
                            <span style="color:red;">Đã hủy</span>
                        @else
                            {{ $order->status }}
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" style="margin-right: 5px;">👁️ Xem</a>

                        <a href="{{ route('admin.orders.edit', $order->id) }}" style="margin-right: 5px;">✏️ Sửa</a>

                        @if($order->status == 'pending')
                            <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" style="background:green; color:white; border:none; padding:4px 8px; cursor:pointer;">
                                    ✅ Xác nhận giao
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')" style="background:red; color:white; border:none; padding:4px 8px; cursor:pointer;">
                                🗑️ Xóa
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center;">Không có đơn hàng nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:15px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection
