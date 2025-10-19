<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tạo bảng 'carts' (Giỏ hàng - đóng vai trò là container)
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            // Liên kết với người dùng (user). CÓ THỂ NULL nếu là khách (guest user)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            
            // Dùng để lưu Session ID nếu người dùng chưa đăng nhập
            $table->string('session_id')->nullable()->unique();
            
            $table->timestamps(); 
        });

        // 2. Tạo bảng 'cart_items' (Chi tiết các món ăn trong giỏ)
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            // Liên kết với giỏ hàng (Cart container)
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            
            // Liên kết với sản phẩm (món ăn)
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Số lượng sản phẩm
            $table->integer('quantity')->default(1);
            
            // Giá tại thời điểm thêm vào giỏ hàng
            $table->decimal('price', 10, 0); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Phải xóa bảng cart_items trước vì nó có khóa ngoại trỏ đến carts
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};
