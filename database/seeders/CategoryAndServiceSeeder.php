<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryAndServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/categories.json'));
        $categories = json_decode($json, true);

        foreach ($categories as $cat) {
            $category = Category::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'icon' => $cat['icon'] ?? null,
            ]);

            foreach($cat['subcategories'] as $sub){
                SubCategory::create([
                    'category_id' => $category->id,
                    'name' => $sub,
                    'slug' => Str::slug($sub),
                ]);
            }
        }
    }
}
