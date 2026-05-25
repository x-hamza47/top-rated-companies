<?php

namespace Database\Seeders;

// use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     CategoryAndServiceSeeder::class,
        //     CompanySeeder::class,
        //     AdminSeeder::class,
        //     UserSeeder::class,
        //     ContactUsSeeder::class,
        //     InsightSeeder::class,
        //     FaqSeeder::class,
        // DevProtectionSeeder::class
        // ]);
        $this->call([
            CategoryAndServiceSeeder::class,
            FaqSeeder::class,
            CompaniesSeeder::class,
            AdminSeeder::class,
            DevProtectionSeeder::class
            // UserSeeder::class,
        ]);
    }
}
