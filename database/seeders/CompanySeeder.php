<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        // Fetch once (optimization)
        $allServiceIds = DB::table('services')->pluck('id')->toArray();

        // Pre-generate all company names to avoid duplicates
        $uniqueCompanyNames = [];
        while (count($uniqueCompanyNames) < 200) {
            $uniqueCompanyNames[] = $faker->unique()->company;
        }

        // We need these later for reviewers
        $createdCompanyIds = [];

        for ($i = 0; $i < 200; $i++) {

            // -----------------------------------
            // * Create Company
            // -----------------------------------
            $companyId = DB::table('companies')->insertGetId([
                'logo'       => 'https://picsum.photos/360/360?random=' . rand(1, 99999),
                'name'       => $uniqueCompanyNames[$i],
                'about'      => $faker->paragraph(10),
                'tagline'    => $faker->sentence,
                'verified'   => $faker->boolean(30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $createdCompanyIds[] = $companyId;

            // -----------------------------------
            // * Insert Details
            // -----------------------------------
            DB::table('company_details')->insert([
                'company_id'       => $companyId,
                'min_project_size' => '$' . $faker->numberBetween(1000, 10000),
                'hourly_rate_min'  => $faker->numberBetween(10, 50),
                'hourly_rate_max'  => $faker->numberBetween(60, 150),
                'employees_min'    => $faker->numberBetween(1, 10),
                'employees_max'    => $faker->numberBetween(20, 500),
                'locations'        => $faker->city,
                'founded'          => $faker->year,
                'languages'        => json_encode(
                    $faker->randomElements(
                        ['English', 'Arabic', 'French', 'Chinese', 'Spanish'],
                        rand(1, 3)
                    )
                ),
                'website'      => $faker->url,
                'social_links' => json_encode([
                    'linkedin'  => $faker->url,
                    'facebook'  => $faker->url,
                    'instagram' => $faker->url,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // -----------------------------------
            // * Attach 4–7 Services With Perfect Percentages
            // -----------------------------------
            $serviceCount = rand(4, 6);
            $selectedServices = $faker->randomElements($allServiceIds, $serviceCount);

            // Create random weights
            $weights = [];
            for ($w = 0; $w < $serviceCount; $w++) {
                $weights[] = rand(10, 100);
            }

            // Convert weights → percentages (sum always 100)
            $totalWeight = array_sum($weights);
            $percentageList = [];

            foreach ($weights as $weight) {
                $percentageList[] = round(($weight / $totalWeight) * 100);
            }

            // Fix rounding diff
            $diff = 100 - array_sum($percentageList);
            $percentageList[0] += $diff;

            // Insert pivot
            foreach ($selectedServices as $index => $serviceId) {
                DB::table('company_services')->insert([
                    'company_id'          => $companyId,
                    'service_id'          => $serviceId,
                    'expertise_percentage' => $percentageList[$index],
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
            }
        }

        // -----------------------------------
        // * Add Reviews AFTER all companies exist
        // -----------------------------------

        foreach ($createdCompanyIds as $companyId) {

            // Reviewers = all except itself
            $reviewers = array_diff($createdCompanyIds, [$companyId]);

            // Each company gets 10–20 reviews
            $reviewCount = rand(10, 20);

            // Fetch services of this company (so reviews match services)
            $servicesOfCompany = DB::table('company_services')
                ->where('company_id', $companyId)
                ->pluck('service_id')
                ->toArray();

            for ($r = 0; $r < $reviewCount; $r++) {

                DB::table('reviews')->insert([
                    'company_id'     => $companyId,
                    'service_id'     => $faker->randomElement($servicesOfCompany),

                    'reviewer_id'    => $faker->randomElement($reviewers),
                    'reviewer_type'  => 'App\\Models\\Company',

                    'review'          => $faker->paragraph,
                    'project_title'   => $faker->sentence,
                    'project_size'    => "$" . $faker->numberBetween(2000, 50000),
                    'project_duration' => $faker->numberBetween(1, 12) . " months",
                    'project_summary' => $faker->paragraph(5),

                    'rating'          => rand(1, 5),
                    'quality'         => rand(1, 5),
                    'schedule'        => rand(1, 5),
                    'cost'            => rand(1, 5),
                    'willing_to_refer' => rand(1, 5),

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
