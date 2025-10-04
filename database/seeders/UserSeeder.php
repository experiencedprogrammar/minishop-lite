<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => Hash::make('Admin@12'),
            ]
        );

        // Customer user
        User::updateOrCreate(
            ['email' => 'customer@demo.com'],
            [
                'name' => 'Customer',
                'role' => 'customer',
                'password' => Hash::make('Customer@12'),
            ]
        );
    }
}
