<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'تحويل الملفات',
                'slug' => 'file-conversion',
                'description' => 'تحويل الصور وملفات PDF إلى مستندات Word.',
                'price' => 5.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],
            [
                'name' => 'التفريغ الصوتي',
                'slug' => 'audio-transcription',
                'description' => 'تحويل التسجيلات الصوتية إلى نصوص مكتوبة.',
                'price' => 15.00,
                'pricing_type' => 'per_min',
                'is_active' => true,
            ],
            [
                'name' => 'كتابة المحتوى',
                'slug' => 'content-writing',
                'description' => 'كتابة محتوى عربي وتنسيقه حسب احتياجاتك.',
                'price' => 10.00,
                'pricing_type' => 'per_page',
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
