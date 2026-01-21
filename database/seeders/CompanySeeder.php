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

            $hourlyRanges = [
                '<25',
                '20-50',
                '50-99',
                '100-149',
                '150-199',
                '200-300',
                '300+'
            ];

            $employeeRanges = [
                '2-9',
                '10-49',
                '50-249',
                '250-999',
                '1000-9999',
                '10000+'
            ];

            $socialLinks = [
                'linkedin'  => $faker->url,
                'facebook'  => $faker->url,
                'instagram' => $faker->url,
                'twitter'   => $faker->url,
            ];
            $isFreelancer = $faker->boolean(20); 
            
            DB::table('company_details')->insert([
                'company_id'       => $companyId,
                'min_project_size' => round($faker->numberBetween(1000, 10000), -3),

                'hourly_rate'      => $faker->randomElement($hourlyRanges),

                'employees_range'  => $isFreelancer ? null : $faker->randomElement($employeeRanges),
                'is_freelancer'    => $isFreelancer,

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

            // Get services the company actually provides
            $companyServices = DB::table('company_services')
                ->where('company_id', $companyId)
                ->pluck('service_id')
                ->toArray();

            // Shuffle services so packages are random
            shuffle($companyServices);

            $totalPackagesAllowed = 5;
            $packagesCreated = 0;

            foreach ($companyServices as $serviceId) {
                if ($packagesCreated >= $totalPackagesAllowed) break;

                $typeOptions = ['small', 'medium', 'large'];
                $type = $faker->randomElement($typeOptions);

                // Create one package per service
                $packageId = DB::table('packages')->insertGetId([
                    'company_id' => $companyId,
                    'service_id' => $serviceId,
                    'type'       => $type,
                    'price'      => rand(1000, 20000),
                    'price_type' => rand(0, 1) ? 'total' : 'monthly',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // --- Add features for this package ---
                $featuresList = [
                    [
                        'feature' => 'Size of the project',
                        'type'    => 'text',
                        'values'  => ['3 months for 5 FTE team', '6+ months for 5 FTE team', '12+ months for 5 FTE team']
                    ],
                    [
                        'feature' => 'Discovery goals identification and discovery phase schedule preparation',
                        'type'    => 'checkbox',
                        'values'  => [false, true, true]
                    ],
                    [
                        'feature' => 'Domain or industry research and competitor analysis',
                        'type'    => 'checkbox',
                        'values'  => [false, true, true]
                    ],
                    [
                        'feature' => 'Product vision definition',
                        'type'    => 'checkbox',
                        'values'  => [true, true, true]
                    ],
                    [
                        'feature' => 'Stakeholder interviews or surveys (per team involved)',
                        'type'    => 'text',
                        'values'  => ['up to 24 hours', 'up to 48 hours', 'up to 72 hours']
                    ],
                    [
                        'feature' => 'User research, empathy mapping and persona creation (per team involved)',
                        'type'    => 'text',
                        'values'  => ['Feature Not Included', 'up to 16 hours', 'up to 24 hours']
                    ],
                ];

                foreach ($featuresList as $feature) {
                    $index = match ($type) {
                        'small'  => 0,
                        'medium' => 1,
                        'large'  => 2,
                        default  => 0,
                    };

                    DB::table('package_features')->insert([
                        'package_id' => $packageId,
                        'feature'    => $feature['feature'],
                        'type'       => $feature['type'],
                        'value'      => $feature['type'] === 'text' ? $feature['values'][$index] : null,
                        'included'   => $feature['type'] === 'checkbox' ? $feature['values'][$index] : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $packagesCreated++;
            }

            // -------------------------------
            // * Add Inquiries for Company
            // -------------------------------
            $inquiryCount = rand(5, 15); 

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

            $reviewCount = rand(10, 20);

            $servicesOfCompany = DB::table('company_services')
                ->where('company_id', $companyId)
                ->pluck('service_id')
                ->toArray();

            // Skip if company has no services
            if (empty($servicesOfCompany)) {
                continue;
            }

            for ($r = 0; $r < $reviewCount; $r++) {

                DB::table('reviews')->insert([
                    // Relations
                    'company_id' => $companyId,

                    'service_id' => $faker->randomElement($servicesOfCompany),

                    // Reviewer details (fake client)
                    'reviewer_name' => $faker->name,
                    'reviewer_email' => $faker->safeEmail,
                    'reviewer_location' => $faker->city . ', ' . $faker->country,
                    'reviewer_company' => $faker->company,
                    'reviewer_company_bio' => $faker->paragraph,
                    'reviewer_designation' => $faker->jobTitle,
                    'reviewer_employees' => $faker->numberBetween(20, 500),

                    // Review content
                    'review' => $faker->realText(100),
                    'summary' => $faker->sentence,

                    // Ratings (1–5)
                    'rating' => rand(3, 5),
                    'quality' => rand(3, 5),
                    'ai' => rand(3, 5),
                    'schedule' => rand(3, 5),
                    'cost' => rand(3, 5),
                    'willing_to_refer' => rand(3, 5),

                    // Project details
                    'project_title' => $faker->sentence,
                    'project_size' => '$' . $faker->numberBetween(2000, 50000),
                    'project_duration' => $faker->numberBetween(1, 12) . ' months',
                    'project_summary' => $faker->paragraph(3),

                    // Analytics
                    'source' => $faker->randomElement(['10firms', 'Google Search', 'Others']),
                    'reference' => $faker->url,
                    'status' => $faker->randomElement(['unlisted', 'verified']),

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
