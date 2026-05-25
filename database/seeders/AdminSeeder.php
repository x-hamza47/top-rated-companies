<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'firstName' => 'Hamza',
                'lastName' => 'Aamir',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );
        User::firstOrCreate(
            ['email' => 'hamzaamir72007@gmail.com'],
            [
                'firstName' => 'Hamza',
                'lastName' => 'Aamir',
                'password' => Hash::make('hamza65724$topfirms'),
                'role' => 'admin'
            ]
        );

        User::firstOrCreate(
            ['email' => 'amrita@gmail.com'],
            [
                'firstName' => 'Amrita',
                'lastName' => 'Admin',
                'password' => Hash::make('amrita123'),
                'role' => 'admin'
            ]
        );
        User::firstOrCreate(
            ['email' => 'syedzainulabidinali@gmail.com'],
            [
                'firstName' => 'Zain',
                'lastName' => 'Ali',
                'password' => Hash::make('zain123'),
                'role' => 'admin'
            ],
        );
    }
}
// composer install --no-dev --optimize-autoloader
// php artisan migrate --force
// php artisan config:cache
// php artisan view:cache