<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [

            ['key' => 'site_name', 'value' => 'Beliaja'],

            ['key' => 'site_description', 'value' => 'CMS Toko Online Laravel 12'],

            ['key' => 'whatsapp', 'value' => '628123456789'],

            ['key' => 'email', 'value' => 'admin@example.com'],

            ['key' => 'address', 'value' => 'Indonesia'],

            ['key' => 'logo', 'value' => null],

            ['key' => 'favicon', 'value' => null],

            ['key' => 'hero_title', 'value' => 'Selamat Datang'],

            ['key' => 'hero_subtitle', 'value' => 'Temukan Produk Terbaik'],

            ['key' => 'facebook', 'value' => null],

            ['key' => 'instagram', 'value' => null],

            ['key' => 'tiktok', 'value' => null],

        ];

        foreach ($settings as $setting) {

            Setting::updateOrCreate(

                ['key' => $setting['key']],

                ['value' => $setting['value']]

            );

        }
    }
}