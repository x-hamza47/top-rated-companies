<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'logo' => 'default.png',
            'verified' => $this->faker->boolean(70),
            'name' => $this->faker->company(),
            'about' => $this->faker->paragraph(4),
            'tagline' => $this->faker->catchPhrase(),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
