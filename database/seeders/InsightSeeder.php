<?php

namespace Database\Seeders;

use App\Models\Insight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Insight::factory()->count(50)->create();
    }
}
