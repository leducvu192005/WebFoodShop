<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Danh sách sản phẩm
    public function index(Request $request)
{
    // Lấy từ khóa tìm kiếm (nếu có)
    $search = $request->input('search', '');

    // Lọc sản phẩm theo từ khóa
    $products = Product::when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%');
    })->paginate(10);

    // Giữ lại từ khóa khi chuyển trang
    $products->appends(['search' => $search]);

    return view('admin.products.index', compact('products', 'search'));
}
//lọc sản phẩm
public function menu(Request $request)
{
    $category = $request->category ?? 'all';

    // Lấy danh sách category duy nhất
    $categories = Product::select('category')->distinct()->pluck('category');
    $categories->prepend('all'); // Thêm "all" vào đầu

    // Lọc sản phẩm
    $products = Product::when($category !== 'all', function($query) use ($category) {
            return $query->where('category', $category);
        })
        ->paginate(9);

    return view('user.menu.index', compact('products', 'category', 'categories'));
}



    // Form thêm mới
    public function create()
    {
        return view('admin.products.create');
    }

    // Lưu sản phẩm mới
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'original_price' => 'nullable|numeric|min:0',
        'discount' => 'nullable|numeric|min:0|max:100',
        'stock' => 'required|integer|min:0',
        'category' => 'nullable|string|max:255',
        'isNew' => 'nullable', // checkbox
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    // Gán cột đúng với DB
    $validated['is_new'] = $request->has('isNew') ? 1 : 0;

    Product::create($validated);

    return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
}



    // Form chỉnh sửa
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Cập nhật sản phẩm
  public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'originalPrice' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category' => 'nullable|string|max:255',
        'discount' => 'nullable|numeric|min:0|max:100',
        'isNew' => 'nullable|boolean',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $validated['image'] = $path;
    }

    // Gán lại đúng tên cột DB (nếu khác tên input)
    $validated['original_price'] = $validated['originalPrice'] ?? null;
    $validated['is_new'] = $request->has('isNew') ? 1 : 0;
    unset($validated['originalPrice'], $validated['isNew']);

    $product->update($validated);

    return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
}

    // Xóa sản phẩm
    public function destroy(Product $product)
    {
        $product->forceDelete(); // ✅ Xóa hẳn khỏi database

        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}
