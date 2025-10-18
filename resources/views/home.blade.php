@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <span class="badge bg-warning text-dark mb-3">🎉 Miễn phí giao hàng cho đơn từ 200.000đ</span>
            <h1 class="fw-bold">Đặt đồ ăn yêu thích <span class="text-danger">ngay tại nhà</span></h1>
            <p class="text-muted">Hàng nghìn món ăn ngon từ các nhà hàng hàng đầu. Giao hàng nhanh chóng trong 30 phút.</p>
            <div class="d-flex gap-3 mt-4">
                <button class="btn btn-danger">Đặt hàng ngay</button>
                <button class="btn btn-outline-dark">Xem thực đơn</button>
            </div>
            <div class="d-flex gap-4 mt-4 text-muted">
                <div><strong>1000+</strong><br>Món ăn</div>
                <div><strong>500+</strong><br>Nhà hàng</div>
                <div><strong>4.8⭐</strong><br>Đánh giá</div>
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('images/hero-food.jpg') }}" alt="Đặt đồ ăn" class="img-fluid rounded-4 shadow-sm">
        </div>
    </div>

    <!-- Danh sách món ăn -->
    <h2 class="fw-bold mt-5 mb-4">Món ăn nổi bật</h2>
    <div class="row g-4">
        @php
            $foods = [
                ['img'=>'smoothie.jpg','name'=>'Smoothie Dâu Tây','desc'=>'Sinh tố dâu tây tươi với sữa chua Hy Lạp, mật ong và hạt chia','price'=>'49.000đ','rating'=>'4.7 (134)'],
                ['img'=>'burger.jpg','name'=>'Burger Gà Giòn Cay','desc'=>'Gà giòn tẩm ướp cay, rau xanh, phô mai, sốt mayonnaise','price'=>'75.000đ','rating'=>'4.5 (201)'],
                ['img'=>'ramen.jpg','name'=>'Ramen Nhật Bản','desc'=>'Mì ramen trong nước dashi đậm đà, thịt xá xíu, trứng onsen','price'=>'95.000đ','rating'=>'4.8 (178)'],
            ];
        @endphp

        @foreach ($foods as $f)
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <img src="{{ asset('images/'.$f['img']) }}" class="card-img-top" alt="{{ $f['name'] }}">
                <div class="card-body">
                    <p class="text-muted mb-1">⭐ {{ $f['rating'] }}</p>
                    <h5 class="card-title">{{ $f['name'] }}</h5>
                    <p class="card-text text-muted">{{ $f['desc'] }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="fw-bold text-danger">{{ $f['price'] }}</span>
                        <a href="#" class="btn btn-outline-danger btn-sm">Thêm</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
