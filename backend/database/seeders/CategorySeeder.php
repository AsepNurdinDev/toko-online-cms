<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            'Elektronik',

            'Fashion',

            'Makanan',

            'Minuman',

        ];

        foreach ($categories as $category) {

            Category::updateOrCreate(

                ['slug' => Str::slug($category)],

                [

                    'name' => $category,

                    'description' => $category,

                    'is_active' => true,

                ]

            );

        }
    }
}