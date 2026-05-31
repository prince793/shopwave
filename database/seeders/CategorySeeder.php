<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Gadgets, devices, and tech accessories.', 'icon' => '📱'],
            ['name' => 'Clothing', 'description' => 'Fashion for men, women, and kids.', 'icon' => '👕'],
            ['name' => 'Home & Living', 'description' => 'Furniture, decor, and home essentials.', 'icon' => '🏠'],
            ['name' => 'Sports', 'description' => 'Sports equipment and activewear.', 'icon' => '⚽'],
            ['name' => 'Books', 'description' => 'Books, magazines, and educational materials.', 'icon' => '📚'],
            ['name' => 'Beauty', 'description' => 'Skincare, makeup, and personal care.', 'icon' => '💄'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'        => $cat['name'],
                'slug'        => Str::slug($cat['name']) . '-' . uniqid(),
                'description' => $cat['description'],
                'is_active'   => true,
            ]);
        }
    }
}