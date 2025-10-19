<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'quantity',
        'price', // nếu muốn
        'user_id' // nếu muốn theo user
    ];
}
