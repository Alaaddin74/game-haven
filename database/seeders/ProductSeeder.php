<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Elden Ring',
                'category_id' => 1,
                'platform' => 'PS5',
                'price' => 59.99,
                'stock_quantity' => 100,
                'description' => 'An epic dark fantasy action RPG.',
                'image_url' => 'images/products/elden-ring.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DualSense Wireless Controller',
                'category_id' => 3,
                'platform' => 'PS5',
                'price' => 69.99,
                'stock_quantity' => 50,
                'description' => 'Official PlayStation 5 controller.',
                'image_url' => 'images/products/dualsense.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
