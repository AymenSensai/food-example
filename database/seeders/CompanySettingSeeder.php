<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CompanySetting::create([
            'email' => 'contact@foodadmin.com',
            'phone' => '+213 555 123 456',
            'address' => '123 Rue de la Liberté, Alger, Algérie',
            'tiktok_url' => 'https://tiktok.com/@foodadmin',
            'instagram_url' => 'https://instagram.com/foodadmin',
            'facebook_url' => 'https://facebook.com/foodadmin',
        ]);
    }
}
