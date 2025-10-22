<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
   
    public function index(Request $request)
    {
        $category = $request->input('category', 'all');

        $products = Product::when($category !== 'all', function ($query) use ($category) {
            return $query->where('category', $category);
        })->paginate(12);

        $products->appends(['category' => $category]);

        return view('user.menu.index', compact('products', 'category'));
    }

   
    public function cart()
    {
        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shippingFee = $subtotal > 0 ? 30000 : 0;

        return view('user.cart.index', compact('cart', 'subtotal', 'shippingFee'));
    }

    public function show(Product $product)
    {
        $reviews = $product->reviews()->get();

        return view('user.menu.show', compact('product', 'reviews'));
    }

 
    public function addToCart(Request $request, Product $product)
    {
        $quantity = max(1, (int)$request->input('quantity', 1));

        $cart = session()->get('cart', []);

        $cart[$product->id] = [
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
            'quantity'   => $quantity,
            'image'      => $product->image,
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

 
    public function flashSale()
    {
        $products = Product::whereNotNull('discount')
            ->where('discount', '>', 0)
            ->orderByDesc('discount')
            ->get();

        return view('user.promotions.flash_sale', compact('products'));
    }

   
    public function home()
{
    $saleProducts = Product::whereNotNull('discount')
        ->where('discount', '>', 0)
        ->orderByDesc('discount')
        ->take(1)
        ->get();

    $products = Product::orderByDesc('rating')
        ->take(6)
        ->get();

    return view('home', compact('saleProducts', 'products'));
}

}
