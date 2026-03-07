<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;

class CompaniesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();


        $jsonPath = database_path('seeders/data/companies.json');
        if (!file_exists($jsonPath)) {
            $this->command->error('companies.json not found!');
            return;
        }

        $companiesData = json_decode(file_get_contents($jsonPath), true);
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($companiesData)) {
            $this->command->error('Invalid JSON in clutch_companies.json');
            return;
        }

        $allServiceIds = DB::table('services')->pluck('id', 'name')->toArray(); // key by name for mapping

        if (empty($allServiceIds)) {
            $this->command->error('No services in DB. Please seed services table first.');
            return;
        }

        $createdCompanyIds = [];

        foreach ($companiesData as $realCompany) {
            // -------------------------------
            // Create Company with real data
            // -------------------------------
            $slug = Str::slug($realCompany['name']);

            $companyId = DB::table('companies')->insertGetId([
                'user_id'    => null,
                'logo'       => $realCompany['logo'] ?? null,
                'name'       => $realCompany['name'],
                'about'      => $realCompany['about'] ?? $faker->paragraph(8),
                'slug'       => $slug,
                'tagline'    => $realCompany['tagline'] ?? $faker->sentence,
                'is_listed'  => $realCompany['is_listed'] ?? true,
                'verified'   => $realCompany['verified'] ?? true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $createdCompanyIds[] = $companyId;

            // -------------------------------
            // Company Details — mostly real
            // -------------------------------
            $hourlyRanges   = config('company.hourly_rates', ['<25', '25-49', '50-99', '100-149', '150-199']);
            $employeeRanges = config('company.employee_ranges', ['1-9', '10-49', '50-249', '250-999', '1000-9999']);

            $socialLinks = $realCompany['social_links'] ?? [
                'linkedin'  => $faker->url,
                'twitter'   => $faker->url,
            ];

            $isFreelancer = count(explode('-', $realCompany['employees_range'] ?? '50-249')) === 1 && (int) $realCompany['employees_range'] < 10;

            DB::table('company_details')->insert([
                'company_id'       => $companyId,
                'min_project_size' => $realCompany['min_project_size'] ?? $faker->randomElement(['1000', '5000', '10000', '25000', '50000', '75000']),
                'hourly_rate'      => $realCompany['hourly_rate'] ?? $faker->randomElement($hourlyRanges),
                'employees_range'  => $isFreelancer ? null : ($realCompany['employees_range'] ?? $faker->randomElement($employeeRanges)),
                'is_freelancer'    => $isFreelancer,
                'locations'        => $realCompany['location'] ?? $faker->city . ', ' . $faker->country,
                'founded'          => $realCompany['founded'] ?? $faker->year(2005, date('Y')),
                'languages'        => json_encode(['English']), // most Clutch top are English-primary
                'website'          => $realCompany['website'] ?? $faker->url,
                'social_links'     => json_encode($socialLinks),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);

            // -------------------------------
            // Attach Services — prefer real percentages
            // -------------------------------
            $servicesAdded = false;

            if (!empty($realCompany['services'])) {
                foreach ($realCompany['services'] as $svc) {
                    $serviceName = $svc['name'];
                    $serviceId = $allServiceIds[$serviceName] ?? null;

                    if ($serviceId) {
                        DB::table('company_services')->insert([
                            'company_id'           => $companyId,
                            'service_id'           => $serviceId,
                            'expertise_percentage' => $svc['percentage'],
                            'created_at'           => now(),
                            'updated_at'           => now(),
                        ]);
                        $servicesAdded = true;
                    }
                }
            }

            // Fallback if no services were matched
            if (!$servicesAdded) {
                $serviceCount = rand(3, 6);
                $selected = $faker->randomElements(array_values($allServiceIds), $serviceCount);

                $weights = array_map(fn() => rand(10, 100), range(1, $serviceCount));
                $total = array_sum($weights);
                $percentages = array_map(fn($w) => round(($w / $total) * 100), $weights);
                $percentages[0] += 100 - array_sum($percentages); // fix rounding

                foreach ($selected as $idx => $id) {
                    DB::table('company_services')->insert([
                        'company_id'           => $companyId,
                        'service_id'           => $id,
                        'expertise_percentage' => $percentages[$idx],
                        'created_at'           => now(),
                        'updated_at'           => now(),
                    ]);
                }
            }

            // -------------------------------
            // Packages + Features (dummy, unchanged)
            // -------------------------------
            // $companyServices = DB::table('company_services')
            //     ->where('company_id', $companyId)
            //     ->pluck('service_id')
            //     ->toArray();

            // if (!empty($companyServices)) {
            //     shuffle($companyServices);
            //     $maxWithPackages = 5;
            //     $withPackages = array_slice($companyServices, 0, $maxWithPackages);

            //     foreach ($withPackages as $serviceId) {
            //         $basePrice = rand(800, 15000);
            //         $multipliers = ['small' => 1, 'medium' => 1.6, 'large' => 2.4];

            //         $packageId = DB::table('packages')->insertGetId([
            //             'company_id'   => $companyId,
            //             'service_id'   => $serviceId,
            //             'small_price'  => round($basePrice * $multipliers['small']),
            //             'medium_price' => round($basePrice * $multipliers['medium']),
            //             'large_price'  => round($basePrice * $multipliers['large']),
            //             'price_type'   => $faker->randomElement(['total', 'monthly']),
            //             'description'  => $faker->sentence(),
            //             'created_at'   => now(),
            //             'updated_at'   => now(),
            //         ]);

            //         // Your fixed features list (unchanged)
            //         $featuresList = [
            //             [
            //                 'feature' => 'Size of the project',
            //                 'type' => 'text',
            //                 'small_value' => '3 months for 5 FTE team',
            //                 'medium_value' => '6+ months for 5 FTE team',
            //                 'large_value' => '12+ months for 5 FTE team'
            //             ],
            //             [
            //                 'feature' => 'Discovery goals identification and discovery phase schedule preparation',
            //                 'type' => 'checkbox',
            //                 'small_value' => false,
            //                 'medium_value' => true,
            //                 'large_value' => true
            //             ],
            //             [
            //                 'feature' => 'Domain or industry research and competitor analysis',
            //                 'type' => 'checkbox',
            //                 'small_value' => false,
            //                 'medium_value' => true,
            //                 'large_value' => true
            //             ],
            //             [
            //                 'feature' => 'Product vision definition',
            //                 'type' => 'checkbox',
            //                 'small_value' => true,
            //                 'medium_value' => true,
            //                 'large_value' => true
            //             ],
            //             [
            //                 'feature' => 'Stakeholder interviews or surveys (per team involved)',
            //                 'type' => 'text',
            //                 'small_value' => 'up to 24 hours',
            //                 'medium_value' => 'up to 48 hours',
            //                 'large_value' => 'up to 72 hours'
            //             ],
            //             [
            //                 'feature' => 'User research, empathy mapping and persona creation (per team involved)',
            //                 'type' => 'text',
            //                 'small_value' => 'Feature Not Included',
            //                 'medium_value' => 'up to 16 hours',
            //                 'large_value' => 'up to 24 hours'
            //             ],
            //         ];


            //         foreach ($featuresList as $feature) {
            //             DB::table('package_features')->insert([
            //                 'package_id'   => $packageId,
            //                 'feature'      => $feature['feature'],
            //                 'type'         => $feature['type'],
            //                 'small_value'  => $feature['small_value'],
            //                 'medium_value' => $feature['medium_value'],
            //                 'large_value'  => $feature['large_value'],
            //                 'created_at'   => now(),
            //                 'updated_at'   => now(),
            //             ]);
            //         }
            //     }
            // }

            // -------------------------------
            // Inquiries (dummy, unchanged)
            // -------------------------------
            // $inquiryCount = rand(4, 12);
            // for ($q = 0; $q < $inquiryCount; $q++) {
            //     DB::table('inquiries')->insert([
            //         'company_id' => $companyId,
            //         'name'       => $faker->name,
            //         'email'      => $faker->safeEmail,
            //         'phone'      => $faker->phoneNumber,
            //         'subject'    => $faker->sentence(4),
            //         'message'    => $faker->paragraph(3),
            //         'status'     => $faker->randomElement(['pending', 'resolved']),
            //         'read_at'    => $faker->boolean(40) ? now() : null,
            //         'ip_address' => $faker->ipv4,
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ]);
            // }
        }

        // -------------------------------
        // Reviews — REDUCED COUNT for realism 
        // -------------------------------
        foreach ($createdCompanyIds as $companyId) {
            $reviewCount = rand(8, 10); // more realistic than 10-20

            $servicesOfCompany = DB::table('company_services')
                ->where('company_id', $companyId)
                ->pluck('service_id')
                ->toArray();

            if (empty($servicesOfCompany)) continue;

            $reviewSummaries = [
                'Great communication and timely delivery throughout the project.',
                'The team delivered high-quality work and exceeded expectations.',
                'Professional approach with strong technical expertise.',
                'Very responsive team that understood our requirements well.',
                'Excellent results and smooth collaboration from start to finish.',
            ];

            $projectTitles = [
                'Custom Web Application Development',
                'Enterprise Dashboard and API Integration',
                'Full Stack Platform Development',
                'UI/UX Design and Frontend Implementation',
                'Scalable Backend System Development',
            ];

            $projectSummaries = [
                'The team worked closely with us to understand our goals and deliver a reliable solution. All milestones were completed on time, and communication was clear throughout the engagement.',
                'They provided strong technical guidance and implemented features efficiently. The final product met our expectations and performed well in production.',
                'The project was managed professionally with regular updates and quick turnaround on feedback. We are satisfied with the overall quality and results.',
            ];
            for ($r = 0; $r < $reviewCount; $r++) {
                DB::table('reviews')->insert([
                    'company_id'             => $companyId,
                    'service_id'             => $faker->randomElement($servicesOfCompany),

                    'reviewer_name'          => $faker->name,
                    'reviewer_email'         => $faker->safeEmail,
                    'reviewer_location'      => $faker->city . ', ' . $faker->country,
                    'reviewer_company'       => $faker->company,
                    'reviewer_company_bio'   => $faker->paragraph,
                    'reviewer_designation'   => $faker->jobTitle,
                    'reviewer_employees'     => $faker->numberBetween(10, 1000),

                    'review'                 => $faker->realTextBetween(80, 180),
                    'summary'                => $faker->randomElement($reviewSummaries),

                    'rating'                 => rand(4, 5),           // bias toward good ratings (realistic for top Clutch)
                    'quality'                => rand(4, 5),
                    'ai'                     => rand(3, 5),
                    'schedule'               => rand(4, 5),
                    'cost'                   => rand(3, 5),
                    'willing_to_refer'       => rand(4, 5),

                    'project_title'          => $faker->randomElement($projectTitles),
                    'project_size'           => '$' . number_format($faker->numberBetween(5000, 120000), 0, '.', ','),
                    'project_duration'       => $faker->numberBetween(2, 18) . ' months',
                    'project_summary'        =>  $faker->randomElement($projectSummaries),

                    'source'                 => $faker->randomElement(['TopFirms', 'Google', 'Others']),
                    'reference'              => $faker->url,
                    'status'                 => $faker->randomElement(['verified', 'unlisted']),

                    'created_at'             => now(),
                    'updated_at'             => now(),
                ]);
            }
        }

        $this->command->info('Seeded ' . count($companiesData) . 'companies with packages and reviews.');
    }
}
