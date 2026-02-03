<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/servicefaqs.json'));
        $servicesFaqs = json_decode($json, true);

        foreach ($servicesFaqs as $slug => $faqs) {
            $service = Service::where('name', $slug)->first();

            if ($service) {
                foreach ($faqs as $faq) {
                    $service->faqs()->create([
                        'question' => $faq['question'],
                        'answer'   => $faq['answer'],
                    ]);
                }
            }
        }
    }
}
