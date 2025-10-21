

@extends('layouts.admin')

@section('content')
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-5 w-100" style="max-width: 100%; border-radius: 20px;">
        <h3 class="text-center mb-4 fw-bold text-primary">🛍️ Thêm sản phẩm mới</h3>

        {{-- Hiển thị lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form thêm sản phẩm --}}
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nhóm label + input thẳng hàng --}}
            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-semibold">Tên sản phẩm</label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Nhập tên sản phẩm" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-semibold">Mô tả</label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control form-control-lg" rows="3" placeholder="Mô tả sản phẩm"></textarea>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-semibold">Giá (VNĐ)</label>
                <div class="col-sm-9">
                    <input type="number" name="price" class="form-control form-control-lg" min="0" placeholder="Nhập giá" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-semibold">Giá gốc</label>
                <div class="col-sm-9">
                    <input type="number" name="originalPrice" class="form-control form-control-lg" min="0" placeholder="Nhập giá gốc">
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-semibold">Số lượng</label>
                <div class="col-sm-9">
                    <input type="number" name="stock" class="form-control form-control-lg" min="0" placeholder="Nhập số lượng" required>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-semibold">Danh mục</label>
                <div class="col-sm-9">
                    <input type="text" name="category" class="form-control form-control-lg" placeholder="Nhập danh mục sản phẩm">
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-semibold">Giảm giá (%)</label>
                <div class="col-sm-9">
                    <input type="number" name="discount" class="form-control form-control-lg" min="0" max="100" placeholder="Nhập % giảm giá">
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label class="col-sm-3 col-form-label fw-semibold">Sản phẩm mới</label>
                <div class="col-sm-9 d-flex align-items-center">
                    <input class="form-check-input me-2" type="checkbox" name="isNew" id="isNew">
                    <label class="form-check-label fw-semibold" for="isNew">Có</label>
                </div>
            </div>

            <div class="row mb-4 align-items-center">
                <label class="col-sm-3 col-form-label fw-semibold">Ảnh sản phẩm</label>
                <div class="col-sm-9">
                    <input type="file" name="image" class="form-control form-control-lg" accept="image/*" onchange="previewImage(event)">
                    <div class="text-center mt-3">
                        <img id="preview" src="#" alt="Xem trước ảnh"
                             style="max-width: 100%; height: auto; display: none; border-radius: 10px;">
                    </div>
                </div>
            </div>

            {{-- Nút --}}
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4 py-2">
                    ⬅ Quay lại
                </a>
                <button type="submit" class="btn btn-success px-4 py-2">
                    💾 Lưu sản phẩm
                </button>
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

{{-- CSS căn chỉnh --}}
<style>
body {
    background: #f6f8fb;
}
.form-control-lg {
    border-radius: 10px;
}
textarea.form-control-lg {
    height: auto !important;
    min-height: 100px;
}
label.col-form-label {
    text-align: right;
}
.card {
    background: #fff;
}
.btn {
    border-radius: 8px;
    font-weight: 600;
}
</style>
@endsection
