<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function addToCart(Request $request, Product $product)
    {
        $user = auth()->user();
        $quantity = $request->input('quantity', 1);

        $cartItem = CartItem::where('user_id', $user->id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);
        $item->quantity = $request->input('quantity', $item->quantity);
        $item->save();

        return redirect()->route('cart.update')->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    // Xóa sản phẩm
    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return redirect()->route('cart.remove')->with('success', 'Xóa sản phẩm khỏi giỏ thành công!');
    }
}
