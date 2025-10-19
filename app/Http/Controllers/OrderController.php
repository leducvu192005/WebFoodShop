<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CartController;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống.');
        }

        // Tính tổng tiền
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $shippingFee = 20000; // Có thể thay bằng phí động
        $total = $subtotal + $shippingFee;

        // Lưu order
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'note' => $request->note,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Bạn có bảng order_items không? Nếu có thì mình ghi luôn từng sản phẩm vào đây

        // Xóa giỏ hàng
        Session::forget('cart');

        return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
    }
}
