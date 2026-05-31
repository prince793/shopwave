<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::where('name', 'Electronics')->first();
        $clothing    = Category::where('name', 'Clothing')->first();
        $home        = Category::where('name', 'Home & Living')->first();
        $sports      = Category::where('name', 'Sports')->first();
        $books       = Category::where('name', 'Books')->first();
        $beauty      = Category::where('name', 'Beauty')->first();

        $products = [
            ['name' => 'Wireless Earbuds Pro', 'category' => $electronics, 'price' => 1299, 'original_price' => 1999, 'stock' => 50, 'featured' => true, 'description' => 'Premium wireless earbuds with active noise cancellation and 30-hour battery life.', 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400'],
            ['name' => 'Smart Watch Series X', 'category' => $electronics, 'price' => 3499, 'original_price' => 4999, 'stock' => 30, 'featured' => true, 'description' => 'Feature-packed smartwatch with health tracking, GPS, and 7-day battery.', 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400'],
            ['name' => 'Mechanical Keyboard', 'category' => $electronics, 'price' => 2199, 'original_price' => null, 'stock' => 25, 'featured' => false, 'description' => 'RGB mechanical keyboard with tactile switches perfect for gaming and typing.', 'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400'],
            ['name' => 'Classic White Tee', 'category' => $clothing, 'price' => 299, 'original_price' => 499, 'stock' => 100, 'featured' => true, 'description' => 'Premium cotton classic white t-shirt, comfortable for everyday wear.', 'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400'],
            ['name' => 'Slim Fit Jeans', 'category' => $clothing, 'price' => 899, 'original_price' => 1299, 'stock' => 60, 'featured' => false, 'description' => 'Modern slim fit jeans with stretch fabric for all-day comfort.', 'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=400'],
            ['name' => 'Running Sneakers', 'category' => $clothing, 'price' => 1899, 'original_price' => 2499, 'stock' => 40, 'featured' => true, 'description' => 'Lightweight running sneakers with advanced cushioning technology.', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400'],
            ['name' => 'Ceramic Plant Pot Set', 'category' => $home, 'price' => 599, 'original_price' => null, 'stock' => 35, 'featured' => false, 'description' => 'Set of 3 minimalist ceramic plant pots perfect for indoor plants.', 'image' => 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?w=400'],
            ['name' => 'Scented Candle Collection', 'category' => $home, 'price' => 449, 'original_price' => 599, 'stock' => 80, 'featured' => true, 'description' => 'Set of 4 premium scented candles with calming lavender and vanilla fragrances.', 'image' => 'https://images.unsplash.com/photo-1602523961358-f9f03dd557db?w=400'],
            ['name' => 'Yoga Mat Premium', 'category' => $sports, 'price' => 799, 'original_price' => 999, 'stock' => 45, 'featured' => false, 'description' => 'Non-slip premium yoga mat with alignment lines and carry strap.', 'image' => 'https://images.unsplash.com/photo-1601925228209-28ff8c06b04b?w=400'],
            ['name' => 'Dumbbell Set 10kg', 'category' => $sports, 'price' => 1499, 'original_price' => null, 'stock' => 20, 'featured' => true, 'description' => 'Adjustable dumbbell set perfect for home workouts and strength training.', 'image' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=400'],
            ['name' => 'The Pragmatic Programmer', 'category' => $books, 'price' => 699, 'original_price' => 899, 'stock' => 30, 'featured' => false, 'description' => 'A must-read book for every software developer covering best practices and principles.', 'image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400'],
            ['name' => 'Skincare Starter Kit', 'category' => $beauty, 'price' => 1199, 'original_price' => 1599, 'stock' => 55, 'featured' => true, 'description' => 'Complete skincare routine kit with cleanser, toner, moisturizer, and SPF.', 'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'],
        ];

        foreach ($products as $p) {
            Product::create([
                'name'           => $p['name'],
                'slug'           => Str::slug($p['name']) . '-' . uniqid(),
                'category_id'    => $p['category']?->id,
                'description'    => $p['description'],
                'price'          => $p['price'],
                'original_price' => $p['original_price'],
                'stock'          => $p['stock'],
                'image'          => $p['image'],
                'is_featured'    => $p['featured'],
                'is_active'      => true,
            ]);
        }
    }
}