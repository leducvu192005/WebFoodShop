<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search', '');

    $products = Product::when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%');
    })->paginate(10);

    $products->appends(['search' => $search]);

    return view('admin.products.index', compact('products', 'search'));
}
public function menu(Request $request)
{
    $category = $request->category ?? 'all';

    $categories = Product::select('category')->distinct()->pluck('category');
    $categories->prepend('all'); 

    $products = Product::when($category !== 'all', function($query) use ($category) {
            return $query->where('category', $category);
        })
        ->paginate(9);

    return view('user.menu.index', compact('products', 'category', 'categories'));
}



    public function create()
    {
        return view('admin.products.create');
    }

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

    $validated['is_new'] = $request->has('isNew') ? 1 : 0;

    Product::create($validated);

    return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
}



    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

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

    $validated['original_price'] = $validated['originalPrice'] ?? null;
    $validated['is_new'] = $request->has('isNew') ? 1 : 0;
    unset($validated['originalPrice'], $validated['isNew']);

    $product->update($validated);

    return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
}

    public function destroy(Product $product)
    {
        $product->forceDelete(); 

        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}
