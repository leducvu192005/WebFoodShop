@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4" style="max-width: 600px; margin: auto;">
        <h3 class="text-center mb-4 fw-bold text-primary">✏️ Cập nhật đơn hàng #{{ $order->id }}</h3>

        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Tên khách hàng</label>
                <input type="text" class="form-control" value="{{ $order->customer_name }}" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Trạng thái đơn hàng</label>
                <select name="status" class="form-select" required>
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ghi chú (tuỳ chọn)</label>
                <textarea name="note" class="form-control" rows="3" placeholder="Nhập ghi chú nếu có">{{ $order->note }}</textarea>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary px-4">⬅ Quay lại</a>
                <button type="submit" class="btn btn-success px-4">💾 Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
@endsection
