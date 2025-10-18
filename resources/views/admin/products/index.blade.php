@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-center text-primary">Quản lý sản phẩm</h2>

    {{-- Thông báo --}}
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- Thanh công cụ tìm kiếm + thêm sản phẩm --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex w-50">
            <input type="text" name="search" class="form-control me-2" placeholder="🔍 Tìm sản phẩm..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Tìm</button>
        </form>

        <a href="{{ route('admin.products.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm sản phẩm
        </a>
    </div>

    {{-- Bảng sản phẩm --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá (VNĐ)</th>
                    <th>Tồn kho</th>
                    <th>Mô tả</th>
                    <th width="150">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="text-center">{{ $product->id }}</td>

                        {{-- Hiển thị ảnh --}}
                        <td class="text-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Ảnh sản phẩm" class="rounded" width="60" height="60">
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>

                        <td>{{ $product->name }}</td>
                        <td class="text-end">{{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $product->stock ?? 0 }}</td>
                        <td>{{ Str::limit($product->description, 50) }}</td>

                        <td class="text-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil-square"></i> Sửa
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">
                                    <i class="bi bi-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Không có sản phẩm nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $products->links() }}
    </div>
</div>
@endsection
