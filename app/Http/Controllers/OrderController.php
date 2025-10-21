<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Hiển thị trang điền thông tin đặt hàng
     */
    public function checkout()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $shippingFee = 20000;
        $total = $subtotal + $shippingFee;

        return view('user.cart.checkout', compact('cart', 'subtotal', 'shippingFee', 'total'));
    }

    /**
     * Xử lý khi người dùng nhấn xác nhận đặt hàng
     */
    public function store(Request $request)
    {
        // Kiểm tra giỏ hàng
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        // Validate dữ liệu
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
        ]);

        // Tính toán đơn hàng
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $shippingFee = 20000;
        $total = $subtotal + $shippingFee;

        // Lưu đơn hàng
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'note' => $request->note,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Nếu có bảng order_items thì thêm từng sản phẩm vào đó (tùy bạn có bảng này không)
        // foreach ($cart as $item) {
        //     $order->items()->create([
        //         'product_id' => $item['id'],
        //         'quantity' => $item['quantity'],
        //         'price' => $item['price'],
        //     ]);
        // }

        // Xóa giỏ hàng sau khi đặt hàng
        Session::forget('cart');

        return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
    }
}
