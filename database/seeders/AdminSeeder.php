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
            ['email' => 'hamzaamir72007@gmail.com'],
            [
                'firstName' => 'Hamza',
                'lastName'  => 'Aamir',
                'password'  => Hash::make('hamza123'),
                'role'      => 'admin'
            ]
        );

        User::firstOrCreate(
            ['email' => 'amrita@gmail.com'],
            [
                'firstName' => 'Hamza',
                'lastName'  => 'Aamir',
                'password'  => Hash::make('amrita123'),
                'role'      => 'admin'
            ]
        );
        User::firstOrCreate(
            ['email' => 'syedzainulabidinali@gmail.com'],
            [
                'firstName' => 'Zain',
                'lastName'  => 'Ali',
                'password'  => Hash::make('zain123'),
                'role'      => 'admin'
            ]
        );
    }
}
