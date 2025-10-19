@extends('layouts.admin')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%;">
        <h3 class="text-center mb-4 fw-bold text-primary">🛍️ Thêm sản phẩm mới</h3>

        {{-- Hiển thị lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form thêm sản phẩm --}}
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Mô tả</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Mô tả sản phẩm"></textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Giá (VNĐ)</label>
                    <input type="number" name="price" class="form-control" min="0" placeholder="Nhập giá" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Giá gốc (nếu có)</label>
                    <input type="number" name="originalPrice" class="form-control" min="0" placeholder="Nhập giá gốc">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Số lượng tồn kho</label>
                    <input type="number" name="stock" class="form-control" min="0" placeholder="Nhập số lượng" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Danh mục</label>
                <input type="text" name="category" class="form-control" placeholder="Nhập danh mục sản phẩm">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Phần trăm giảm giá (nếu có)</label>
                    <input type="number" name="discount" class="form-control" min="0" max="100" placeholder="Nhập % giảm giá">
                </div>
                <div class="col-md-6 mb-3 d-flex align-items-center mt-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="isNew" id="isNew">
                        <label class="form-check-label" for="isNew">
                            Mới
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Ảnh sản phẩm</label>
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                <div class="text-center mt-3">
                    <img id="preview" src="#" alt="Xem trước ảnh" style="max-width: 100%; height: auto; display: none; border-radius: 10px;">
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">⬅ Quay lại</a>
                <button type="submit" class="btn btn-success px-4">💾 Lưu sản phẩm</button>
            </div>
        </form>
    </div>
</div>

{{-- JS xem trước ảnh --}}
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
    }
</script>
@endsection
