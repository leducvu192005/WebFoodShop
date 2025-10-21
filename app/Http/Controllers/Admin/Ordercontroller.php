<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index(Request $request)
    {
        // Tìm kiếm theo mã đơn hàng hoặc tên khách
        $search = $request->input('search', '');

        $orders = Order::when($search, function($query, $search) {
            return $query->where('id', 'like', "%$search%")
                         ->orWhere('customer_name', 'like', "%$search%");
        })->latest()->paginate(10);

        $orders->appends(['search' => $search]);

        return view('admin.orders.index', compact('orders', 'search'));
    }

   

    // Lưu đơn hàng mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'nullable|string|max:20',
            'total' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,processing,completed,canceled',
        ]);

        Order::create($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Thêm đơn hàng thành công!');
    }

    // Hiển thị chi tiết đơn hàng
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    // Form chỉnh sửa đơn hàng
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    // Cập nhật đơn hàng
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'nullable|string|max:20',
            'total' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,processing,completed,canceled',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật đơn hàng thành công!');
    }

    // Xóa đơn hàng
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đã xóa đơn hàng!');
    }
    public function confirm($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'confirmed'; // hoặc 'processing' nếu bạn muốn
    $order->save();

    return redirect()->route('admin.orders.index')->with('success', '✅ Đơn hàng đã được xác nhận!');
}

// ✅ Hủy đơn hàng
public function cancel($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'canceled';
    $order->save();

    return redirect()->route('admin.orders.index')->with('error', '❌ Đơn hàng đã bị hủy!');
}
}
