<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the Admin User
        User::factory()->create([
            'name' => 'Farmtastic Admin',
            'email' => 'admin@farmtastic.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 2. Create the Staff User
        User::factory()->create([
            'name' => 'Farmtastic Cashier',
            'email' => 'staff@farmtastic.com',
            'password' => Hash::make('staff123'),
            'role' => 'staff',
        ]);
    }
}