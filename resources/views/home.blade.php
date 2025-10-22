@extends('layouts.app')

@section('content')
<div class="container mt-5">
<div class="container mt-5">
  <div class="card shadow-lg border-0 mb-5 p-4 flash-sale-card">
    <div class="row align-items-center g-4 flex-column text-center text-md-start px-4">

      <div class="col-12">
        <h2 class="fw-bold mb-3 text-light" style="font-size: 2rem;">
          🔥 Flash Sale Đặc Biệt Hôm Nay!
        </h2>
        <p class="text-light opacity-75 fs-5 mb-4">
          Giảm giá lên đến <span class="fw-bold text-warning">50%</span> cho những món ăn hot nhất.<br>
          Nhanh tay kẻo hết — chỉ trong hôm nay thôi!
        </p>
        <a href="{{ route('flash.sale') }}" 
           class="btn btn-warning btn-lg rounded-pill px-4 py-2 shadow-sm fw-semibold">
          Xem ngay <i class="bi bi-arrow-right-short"></i>
        </a>
      </div>

      <div class="col-12 d-flex justify-content-center gap-4 flex-wrap mt-4">
        @forelse($saleProducts as $product)
          <img src="{{ asset('storage/' . $product->image) }}" 
               alt="{{ $product->name }}" 
               class="img-fluid rounded shadow flash-sale-img">
        @empty
          <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"
               alt="Flash Sale"
               class="img-fluid rounded shadow flash-sale-img">
          <img src="https://cdn-icons-png.flaticon.com/512/3649/3649463.png"
               alt="Flash Sale"
               class="img-fluid rounded shadow flash-sale-img">
        @endforelse
      </div>

    </div>
  </div>
</div>

<style>
.flash-sale-card {
  max-width: 1200px;
  margin: 0 auto;
  border-radius: 20px;
  background: linear-gradient(90deg, #ff0000, #c63902);
  color: #fff;
  text-align: center;
}

.flash-sale-img {
  max-height: 260px;
  width: auto;
  object-fit: cover;
  border-radius: 15px;
  transition: transform 0.3s ease;
}
.flash-sale-img:hover {
  transform: scale(1.05);
}

@media (max-width: 767.98px) {
  .flash-sale-img {
    max-height: 200px;
  }
}
</style>


<div class="product-section my-5">
  <h2 class="product-title text-center mb-4">🌟 Sản phẩm nổi bật 🌟</h2>

  <div class="product-row-wrapper">
    <div id="product-row" class="product-row">
      @forelse ($products->take(3) as $product)
        <div class="product-card">
          <x-product-card :product="$product" />
        </div>
      @empty
        <p class="text-center text-muted w-100">Hiện chưa có món ăn nào.</p>
      @endforelse
    </div>
  </div>
</div>

<style>
.product-section {
  width: 100%;
  text-align: center; 
}

.product-title {
  display: inline-block;
  font-size: 1.4rem;         
  font-weight: 600;
  color: #333;
  text-transform: uppercase;
  letter-spacing: 1px;
  position: relative;
  margin-bottom: 1rem;
}

.product-title::after {
  content: '';
  display: block;
  width: 50px;               
  height: 3px;
  background-color: #ff6600;
  margin: 6px auto 0;
  border-radius: 2px;
}

.product-row-wrapper {
  width: 100%;
}

.product-row {
  display: flex;
  flex-wrap: nowrap;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  gap: 12rem;                 
  padding: 1rem 2rem;
  align-items: flex-start;
  justify-content: center;
  scroll-behavior: smooth;
}

.product-card {
  flex: 0 0 250px;
  min-width: 250px;
  max-width: 250px;
  box-sizing: border-box;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

.product-row::-webkit-scrollbar {
  height: 8px;
}
.product-row::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 4px;
}
</style>

<script>
(function () {
  const row = document.getElementById('product-row');
  if (!row) return;

  function updateJustify() {
    if (row.scrollWidth > row.clientWidth + 1) {
      row.style.justifyContent = 'flex-start';
    } else {
      row.style.justifyContent = 'center';
    }
  }

  updateJustify();
  window.addEventListener('resize', updateJustify);

  const mo = new MutationObserver(updateJustify);
  mo.observe(row, { childList: true });
})();
</script>


</div>







@endsection
