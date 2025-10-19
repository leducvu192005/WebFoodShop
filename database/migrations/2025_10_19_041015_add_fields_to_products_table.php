<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->decimal('original_price', 12, 2)->nullable();
        $table->integer('rating')->default(0);
        $table->integer('reviews')->default(0);
        $table->boolean('is_new')->default(false);
        $table->integer('discount')->nullable();
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['original_price', 'rating', 'reviews', 'is_new', 'discount']);
    });
}


    /**
     * Reverse the migrations.
     */
};
