<?php

namespace Database\Seeders;

use App\Models\AdSlot;
use Illuminate\Database\Seeder;

class AdSlotSeeder extends Seeder
{
    public function run(): void
    {
        $slots = [
            [
                'name' => 'Sidebar Utama',
                'code' => 'sidebar_main',
                'position' => 'sidebar',
                'html_content' => '<div style="background:#f3f4f6;padding:20px;text-align:center;border:1px dashed #9ca3af;">SLOT IKLAN<br>300 x 250</div>',
                'width' => '300',
                'height' => '250',
                'is_active' => true,
            ],
            [
                'name' => 'Banner Header',
                'code' => 'header_banner',
                'position' => 'header',
                'html_content' => '<div style="background:#e5e7eb;padding:15px;text-align:center;border:1px dashed #9ca3af;">BANNER IKLAN 728 x 90</div>',
                'width' => '728',
                'height' => '90',
                'is_active' => true,
            ],
            [
                'name' => 'In-Article',
                'code' => 'in_article',
                'position' => 'in-article',
                'html_content' => '<div style="background:#f9fafb;padding:15px;text-align:center;border:1px dashed #d1d5db;">IKLAN DI TENGAH ARTIKEL</div>',
                'width' => 'auto',
                'height' => 'auto',
                'is_active' => true,
            ],
        ];

        foreach ($slots as $s) {
            AdSlot::create($s);
        }
    }
}