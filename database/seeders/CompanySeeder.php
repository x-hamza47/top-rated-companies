<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        $allServiceIds = DB::table('services')->pluck('id')->toArray();

        $uniqueCompanyNames = [];
        while (count($uniqueCompanyNames) < 200) {
            $uniqueCompanyNames[] = $faker->unique()->company;
        }

        $createdCompanyIds = [];

        for ($i = 0; $i < 200; $i++) {

            // -------------------------------
            // * Create User first
            // -------------------------------
            $userId = DB::table('users')->insertGetId([
                'firstName' => $faker->firstName,
                'lastName'  => $faker->lastName,
                'phone'  => $faker->phoneNumber,
                'email' => strtolower(Str::slug($uniqueCompanyNames[$i])) . "@example.com",
                'password' => bcrypt('password1234'), 
                'role' => 'company',
                'profile_image' => 'https://i.pravatar.cc/150?img=' . rand(1, 70),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // -------------------------------
            // * Create Company linked to User
            // -------------------------------
            $companyId = DB::table('companies')->insertGetId([
                'user_id'    => $userId,
                'logo'       => 'https://picsum.photos/360/360?random=' . rand(1, 99999),
                'name'       => $uniqueCompanyNames[$i],
                'about'      => $faker->paragraph(10),
                'slug'       => Str::slug($uniqueCompanyNames[$i]),
                'tagline'    => $faker->sentence,
                'verified'   => $faker->boolean(30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $createdCompanyIds[] = $companyId;

            // -------------------------------
            // * Company Details
            // -------------------------------
            $socialLinks = [
                'linkedin'  => $faker->url,
                'facebook'  => $faker->url,
                'instagram' => $faker->url,
                'twitter'   => $faker->url, 
            ];
            DB::table('company_details')->insert([
                'company_id'       => $companyId,
                'min_project_size' => round($faker->numberBetween(1000, 10000), -3),
                'hourly_rate_min'  => $faker->numberBetween(10, 50),
                'hourly_rate_max'  => $faker->numberBetween(60, 150),
                'employees_min'    => $faker->numberBetween(1, 10),
                'employees_max'    => $faker->numberBetween(20, 500),
                'locations'        => $faker->city,
                'founded'          => $faker->year,
                'languages'        => json_encode(
                    $faker->randomElements(['English', 'Arabic', 'French', 'Chinese', 'Spanish'], rand(1, 3))
                ),
                'website'      => $faker->url,
                'social_links'     => json_encode($socialLinks),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // -------------------------------
            // * Attach Services
            // -------------------------------
            $serviceCount = rand(4, 6);
            $selectedServices = $faker->randomElements($allServiceIds, $serviceCount);

            $weights = [];
            for ($w = 0; $w < $serviceCount; $w++) $weights[] = rand(10, 100);

            $totalWeight = array_sum($weights);
            $percentageList = [];
            foreach ($weights as $weight) $percentageList[] = round(($weight / $totalWeight) * 100);
            $diff = 100 - array_sum($percentageList);
            $percentageList[0] += $diff;

            foreach ($selectedServices as $index => $serviceId) {
                DB::table('company_services')->insert([
                    'company_id'          => $companyId,
                    'service_id'          => $serviceId,
                    'expertise_percentage' => $percentageList[$index],
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ]);
            }

            // -------------------------------
            // * Add Inquiries for Company
            // -------------------------------
            $inquiryCount = rand(5, 15); // number of inquiries per company

            for ($q = 0; $q < $inquiryCount; $q++) {
                DB::table('inquiries')->insert([
                    'company_id' => $companyId,
                    'name'       => $faker->name,
                    'email'      => $faker->safeEmail,
                    'phone'      => $faker->phoneNumber,
                    'subject'    => $faker->sentence(4),
                    'message'    => $faker->paragraph(3),
                    'status'  => $faker->randomElement(['pending', 'resolved']),
                    'read_at' => $faker->boolean(30) ? now() : null,
                    'ip_address' => $faker->ipv4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // -------------------------------
        // * Add Reviews
        // -------------------------------
        foreach ($createdCompanyIds as $companyId) {
            $reviewers = array_diff($createdCompanyIds, [$companyId]);
            $reviewCount = rand(10, 20);
            $servicesOfCompany = DB::table('company_services')->where('company_id', $companyId)->pluck('service_id')->toArray();

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
