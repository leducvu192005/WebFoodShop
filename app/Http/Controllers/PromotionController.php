<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PromotionController extends Controller
{
    public function index()
    {
        $products = Product::where('discount', '>', 0)->get();

        return view('user.promotions.index', compact('products'));
    }
}
