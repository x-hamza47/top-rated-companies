<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstName' => 'hamza',
            'lastName' => 'aamir',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

  
        // User::create([
        //     'firstName' => 'Noman',
        //     'lastName' => 'Mobin',
        //     'email' => 'znm@gmail.com',
        //     'password' => Hash::make('password123'),
        //     'role' => 'company',
        // ]);
    }
}
