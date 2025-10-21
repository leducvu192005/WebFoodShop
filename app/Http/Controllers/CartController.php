<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // 🧺 Hiển thị giỏ hàng
    public function index()
    {
        $user = auth()->user();

        // Lấy các sản phẩm trong giỏ của người dùng
        $cart = CartItem::with('product')
                        ->where('user_id', $user->id)
                        ->get();

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $shippingFee = 30000; // Phí vận chuyển mặc định

        // Trả về view giỏ hàng
        return view('user.cart.index', compact('cart', 'total', 'shippingFee'));
    }

    // ➕ Thêm sản phẩm vào giỏ
    public function addToCart(Request $request, Product $product)
    {
        $user = auth()->user();
        $quantity = $request->input('quantity', 1);

        // 🔹 1. Tạo hoặc lấy giỏ hàng cho user
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
        ]);

        // 🔹 2. Kiểm tra xem sản phẩm đã có trong giỏ chưa
        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price, // ✅ thêm giá sản phẩm vào giỏ
            ]);
        }

        return back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // 🔁 Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);
        $item->quantity = $request->input('quantity', $item->quantity);
        $item->save();

        return redirect()->route('cart.index')->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    // ❌ Xóa sản phẩm khỏi giỏ
    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
}
