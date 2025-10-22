<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function checkout()
{
    $user = auth()->user();

    $cart = CartItem::with('product')
                    ->where('user_id', $user->id)
                    ->get();

    if ($cart->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
    }

    $subtotal = $cart->sum(fn($item) => $item->product->price * $item->quantity);
    $shippingFee = 30000;
    $total = $subtotal + $shippingFee;

    return view('user.cart.checkout', compact('cart', 'subtotal', 'shippingFee', 'total'));
}

   

    public function store(Request $request)
{
    $user = auth()->user();

    $cart = CartItem::with('product')
                    ->where('user_id', $user->id)
                    ->get();

    if ($cart->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
    }

    $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:20',
        'customer_address' => 'required|string|max:255',
        'note' => 'nullable|string|max:500',
    ]);

    // ✅ Tính tổng tiền
    $subtotal = $cart->sum(fn($item) => $item->product->price * $item->quantity);
    $shippingFee = 20000;
    $total = $subtotal + $shippingFee;

    // ✅ Lưu đơn hàng
    $order = Order::create([
        'customer_name' => $request->customer_name,
        'customer_phone' => $request->customer_phone,
        'customer_address' => $request->customer_address,
        'note' => $request->note,
        'total' => $total,
        'status' => 'pending',
    ]);

  
    CartItem::where('user_id', $user->id)->delete();

    return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
}

 
}
