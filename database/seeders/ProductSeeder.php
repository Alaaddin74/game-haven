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
                'price' => 59000,
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
                'price' => 69099,
                'stock_quantity' => 50,
                'description' => 'Official PlayStation 5 controller.',
                'image_url' => 'images/products/dualsense.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'God of War: Ragnarok',
                'category_id' => 1,
                'platform' => 'PS5',
                'price' => 61000,
                'stock_quantity' => 80,
                'description' => 'The sequel to the critically acclaimed God of War.',
                'image_url' => 'images/products/gow-ragnarok.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PlayStation 5 Console',
                'category_id' => 2,
                'platform' => 'PS5',
                'price' => 7500000,
                'stock_quantity' => 25,
                'description' => 'Next-gen PlayStation 5 console.',
                'image_url' => 'images/products/ps5-console.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Horizon Forbidden West',
                'category_id' => 1,
                'platform' => 'PS5',
                'price' => 56000,
                'stock_quantity' => 90,
                'description' => 'Explore distant lands and battle new machines.',
                'image_url' => 'images/products/horizon-fw.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Charging Station',
                'category_id' => 3,
                'platform' => 'PS5',
                'price' => 120000,
                'stock_quantity' => 40,
                'description' => 'Charge up to two DualSense controllers simultaneously.',
                'image_url' => 'images/products/charging-station.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
