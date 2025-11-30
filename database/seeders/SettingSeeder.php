<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // 1. General Settings
            'site_name' => 'ProjuktiPlus Academy',
            'site_email' => 'admin@projuktiplus.com',
            'site_phone' => '+8801909605599',
            'site_address' => 'Khulna, Bangladesh',
            'footer_text' => '© 2025 ProjuktiPlus. All rights reserved.',
            'site_logo' => null,
            'site_favicon' => null,

            // 2. SEO Settings (Default Values)
            'meta_title' => 'ProjuktiPlus - Best Learning Platform',
            'meta_description' => 'শিখুন এবং দক্ষতা বাড়ান প্রযুক্তি প্লাস-এর সাথে। ওয়েব ডেভেলপমেন্ট, গ্রাফিক্স ডিজাইন এবং আরও অনেক কিছু।',
            'meta_keywords' => 'lms, education, online course, bangla tutorial',
            'meta_author' => 'ProjuktiPlus Team',
            'og_image' => null, // Social Share Image

            // 3. Appearance Settings
            'primary_color' => '#4F46E5', // Indigo 600
            'accent_color' => '#10B981',  // Emerald 500
            'font_family' => 'Hind Siliguri',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}