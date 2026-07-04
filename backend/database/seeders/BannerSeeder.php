<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::create([

            'title' => 'Selamat Datang',

            'subtitle' => 'Belanja Lebih Mudah',

            'image' => 'default-banner.jpg',

            'button_text' => 'Belanja Sekarang',

            'button_link' => '#',

            'sort_order' => 1,

            'is_active' => true,

        ]);
    }
}