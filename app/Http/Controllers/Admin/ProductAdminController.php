<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductAdminController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|url',
        ]);

        Product::create([
            'name'           => $request->name,
            'slug'           => Str::slug($request->name) . '-' . uniqid(),
            'category_id'    => $request->category_id,
            'description'    => $request->description,
            'price'          => $request->price,
            'original_price' => $request->original_price,
            'stock'          => $request->stock,
            'image'          => $request->image,
            'is_featured'    => $request->has('is_featured'),
            'is_active'      => $request->has('is_active'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $product->update([
            'name'           => $request->name,
            'category_id'    => $request->category_id,
            'description'    => $request->description,
            'price'          => $request->price,
            'original_price' => $request->original_price,
            'stock'          => $request->stock,
            'image'          => $request->image,
            'is_featured'    => $request->has('is_featured'),
            'is_active'      => $request->has('is_active'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted!');
    }
}