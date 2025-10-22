<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::take(12)->get();

        return view('home', compact('products'));
    }
}
