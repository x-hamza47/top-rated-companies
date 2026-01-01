<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        Admin::create([
            'firstName' => 'Hamza',
            'lastName' => 'Aamir',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'profile_image' => 'https://i.pravatar.cc/150?img=1',
        ]);
    }
}
