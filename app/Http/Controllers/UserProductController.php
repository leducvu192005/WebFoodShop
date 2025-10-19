<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    // Danh sách sản phẩm / menu
    public function index(Request $request)
    {
        // Lấy danh mục hiện tại (mặc định 'all')
        $category = $request->input('category', 'all');

        // Lọc sản phẩm theo danh mục nếu cần
        $products = Product::when($category !== 'all', function ($query) use ($category) {
            return $query->where('category', $category);
        })->paginate(12); // số sản phẩm mỗi trang

        // Giữ query khi chuyển trang
        $products->appends(['category' => $category]);

        return view('user.menu.index', compact('products', 'category'));
    }

    // Hiển thị chi tiết sản phẩm
    public function show(Product $product)
{
    // Sử dụng quan hệ reviews() để lấy Collection, luôn Countable
    $reviews = $product->reviews()->get();

    return view('user.menu.show', compact('product', 'reviews'));
}

    // Thêm sản phẩm vào giỏ hàng
    // Nên dùng POST
    public function addToCart(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);

        // Logic thêm vào giỏ hàng (session hoặc database)
        $cart = session()->get('cart', []);
        $cart[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'image' => $product->image,
        ];
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }
}
