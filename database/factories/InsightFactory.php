<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Insight;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insight>
 */
class InsightFactory extends Factory
{
    protected $model = Insight::class;

    public function definition(): array
    {
        $serviceIds = Service::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        $title = $this->faker->sentence(6);

        return [
            'service_id' => $this->faker->randomElement($serviceIds),
            'user_id' => $this->faker->randomElement($userIds),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            'description' => $this->faker->paragraph(2),
            'article'    => $this->summernoteHtml($title),
        ];
    }

    private function summernoteHtml(string $title): string
    {
        $faker = $this->faker;

        $html = '<h1 style="color:#2b6cb0;">' . e($title) . '</h1>';
        $html .= '<p style="font-size:16px;">' . $faker->paragraph(3) . '</p>';
        $html .= '<h2 style="color:#dd6b20;">Introduction</h2>';
        $html .= '<p>' . $faker->paragraph(4) . '</p>';
        $html .= '<h3 style="color:#38a169;">Key Takeaways</h3>';
        $html .= '<ul>';
        for ($i = 0; $i < 5; $i++) {
            $html .= '<li>' . $faker->sentence(10) . '</li>';
        }
        $html .= '</ul>';
        $html .= '<p>' . $faker->paragraph(4) . '</p>';
        $html .= '<blockquote style="border-left:3px solid #4a5568;padding-left:1rem;color:#718096;">' . $faker->sentence(12) . '</blockquote>';
        $html .= '<h3 style="color:#d53f8c;">Conclusion</h3>';
        $html .= '<p>' . $faker->paragraph(5) . '</p>';
        $html .= '<p><a href="' . $faker->url . '" target="_blank">Read more</a></p>';

        return $html;
    }
}
