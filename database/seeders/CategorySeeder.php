<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['life',
        'adventure',
        'love',
        'travel',
        'business',
        'career',
        'finance',
        'friendship',
        'other'];
        foreach($categories as $category)
        {
            Category::query()->create(['name' => $category]);
        }
    }
}
