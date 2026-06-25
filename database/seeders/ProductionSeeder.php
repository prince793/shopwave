<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $categories = [
            ['name' => 'Electronics', 'description' => 'Gadgets, devices, and tech accessories.'],
            ['name' => 'Clothing', 'description' => 'Fashion for men, women, and kids.'],
            ['name' => 'Home & Living', 'description' => 'Furniture, decor, and home essentials.'],
            ['name' => 'Sports', 'description' => 'Sports equipment and activewear.'],
            ['name' => 'Books', 'description' => 'Books, magazines, and educational materials.'],
            ['name' => 'Beauty', 'description' => 'Skincare, makeup, and personal care.'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['name' => $cat['name']],
                [
                    'slug' => Str::slug($cat['name']),
                    'description' => $cat['description'],
                    'is_active' => true,
                ]
            );
        }

        // Products
        $electronics = Category::where('name', 'Electronics')->first();
        $clothing = Category::where('name', 'Clothing')->first();
        $home = Category::where('name', 'Home & Living')->first();

        $products = [
            ['name' => 'Smart Watch Series X', 'category_id' => $electronics->id, 'price' => 3499, 'original_price' => 4999, 'stock' => 30, 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400'],
            ['name' => 'Mechanical Keyboard', 'category_id' => $electronics->id, 'price' => 2199, 'stock' => 25, 'is_featured' => false, 'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400'],
            ['name' => 'Classic White Tee', 'category_id' => $clothing->id, 'price' => 299, 'original_price' => 499, 'stock' => 100, 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400'],
            ['name' => 'Slim Fit Jeans', 'category_id' => $clothing->id, 'price' => 899, 'original_price' => 1299, 'stock' => 60, 'is_featured' => false, 'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400'],
            ['name' => 'Scented Candle Collection', 'category_id' => $home->id, 'price' => 449, 'original_price' => 599, 'stock' => 40, 'is_featured' => false, 'image' => 'https://images.unsplash.com/photo-1602178506517-81df60adfde7?w=400'],
        ];

        foreach ($products as $prod) {
            Product::firstOrCreate(
                ['name' => $prod['name']],
                [
                    'slug' => Str::slug($prod['name']) . '-' . uniqid(),
                    'category_id' => $prod['category_id'],
                    'description' => 'Quality product available at ShopWave.',
                    'price' => $prod['price'],
                    'original_price' => $prod['original_price'] ?? null,
                    'stock' => $prod['stock'],
                    'image' => $prod['image'],
                    'is_featured' => $prod['is_featured'],
                    'is_active' => true,
                ]
            );
        }
    }
}