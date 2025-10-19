<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;


use Illuminate\Http\Request;

class CartController extends Controller
{
    
public function addToCart(Request $request, Product $product)
{
    $user = auth()->user();
    $quantity = $request->input('quantity', 1);

    // Nếu sản phẩm đã có trong giỏ hàng, cộng dồn
    $cartItem = Cart::where('user_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

    if ($cartItem) {
        $cartItem->quantity += $quantity;
        $cartItem->save();
    } else {
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }

    return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
}
}
