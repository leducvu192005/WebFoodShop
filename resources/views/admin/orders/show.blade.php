@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4 text-primary fw-bold">📦 Chi tiết đơn hàng #{{ $order->id }}</h3>

        <div class="mb-3">
            <h5 class="fw-semibold">👤 Thông tin khách hàng</h5>
            <p><strong>Tên:</strong> {{ $order->customer_name }}</p>
            <p><strong>Điện thoại:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->shipping_address }}</p>
        </div>

        <hr>

        <div class="mb-3">
            <h5 class="fw-semibold">🧾 Thông tin đơn hàng</h5>
            <p><strong>Trạng thái:</strong>
                @if($order->status == 'pending')
                    <span class="text-warning">Chờ xử lý</span>
                @elseif($order->status == 'delivered')
                    <span class="text-success">Đã giao</span>
                @elseif($order->status == 'cancelled')
                    <span class="text-danger">Đã hủy</span>
                @endif
            </p>
            <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <hr>

        <div class="mb-3">
            <h5 class="fw-semibold">🍔 Sản phẩm trong đơn hàng</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ number_format($item->product->price, 0, ',', '.') }}₫</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}₫</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <h4><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }}₫</h4>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">⬅ Quay lại</a>
            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary">✏️ Cập nhật đơn hàng</a>
        </div>
    </div>
</div>
@endsection
