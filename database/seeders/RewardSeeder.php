<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rewards')->insert([
            [
                'name' => '10% Discount Voucher',
                'points_required' => 100,
                'stock_quantity' => 200,
                'description' => 'Get 10% off your next purchase.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Free Game Key',
                'points_required' => 500,
                'stock_quantity' => 50,
                'description' => 'Redeem a free game key of our choice.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
