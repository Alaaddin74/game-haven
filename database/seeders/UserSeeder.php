<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'), // Ensure to hash the password
            'role' => 'admin', // Assuming the role field exists
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Customer User',
            'email' => 'alaa@mail.com',
            'password' => Hash::make('11111111'), // Ensure to hash the password
            'role' => 'customer', // Assuming the role field exists
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

}
}
