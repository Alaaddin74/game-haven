<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Game', 'description' => 'Game discs for various platforms'],
            ['name' => 'Console', 'description' => 'Gaming consoles'],
            ['name' => 'Accessories', 'description' => 'Controllers, headsets, etc.'],
        ]);
    }
}
