@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 700px;">
    <h3 class="mb-4">⚙️ Cài đặt hệ thống</h3>

    {{-- Hiển thị thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Tên website</label>
            <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $settings->site_name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Email liên hệ</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $settings->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings->phone ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Logo</label>
            <input type="file" name="logo" class="form-control" accept="image/*" onchange="previewLogo(event)">
            <div class="mt-3 text-center">
                @if(isset($settings->logo))
                    <img id="logo-preview" src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" style="max-height:100px; border-radius:8px;">
                @else
                    <img id="logo-preview" src="#" alt="Xem trước logo" style="display:none; max-height:100px; border-radius:8px;">
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅ Quay lại Dashboard</a>
            <button type="submit" class="btn btn-success">💾 Lưu cài đặt</button>
        </div>
    </form>
</div>

{{-- JS xem trước logo --}}
<script>
function previewLogo(event) {
    const preview = document.getElementById('logo-preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = 'block';
}
</script>
@endsection
