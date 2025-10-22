<?php

namespace App\Models;
use App\Models\Review;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
    'name',
    'description',
    'price',
    'original_price',
    'stock',
    'image',
    'category',
    'rating',
    'reviews',
    'is_new',
    'discount',
];
public function reviews()
{
    return $this->hasMany(Review::class);
}


}