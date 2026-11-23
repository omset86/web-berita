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
            ['name' => 'Politik', 'slug' => 'politik', 'icon' => 'government', 'color' => '#dc2626', 'sort_order' => 1],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi', 'icon' => 'chart', 'color' => '#16a34a', 'sort_order' => 2],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'icon' => 'sport', 'color' => '#2563eb', 'sort_order' => 3],
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'icon' => 'chip', 'color' => '#7c3aed', 'sort_order' => 4],
            ['name' => 'Hiburan', 'slug' => 'hiburan', 'icon' => 'music', 'color' => '#db2777', 'sort_order' => 5],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan', 'icon' => 'heart', 'color' => '#ea580c', 'sort_order' => 6],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan', 'icon' => 'book', 'color' => '#0891b2', 'sort_order' => 7],
        ];

        foreach ($categories as $cat) {
            Category::create(array_merge($cat, ['description' => "Berita terkini seputar {$cat['name']}"]));
        }
    }
}