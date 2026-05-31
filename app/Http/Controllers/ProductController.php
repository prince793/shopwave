<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with('category');

        if ($request->category) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->sort === 'price_asc') $query->orderBy('price');
        elseif ($request->sort === 'price_desc') $query->orderByDesc('price');
        elseif ($request->sort === 'newest') $query->latest();
        else $query->latest();

        $products = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();
        return view('products', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)->get();
        return view('product-detail', compact('product', 'related'));
    }
}