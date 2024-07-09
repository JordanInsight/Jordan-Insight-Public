<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Category::create([
            'category_name' => 'Adventure',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Category::create([
            'category_name' => 'Historical Site',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Category::create([
            'category_name' => 'Culinary',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
