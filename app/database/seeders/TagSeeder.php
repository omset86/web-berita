<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Pemilu2026', 'slug' => 'pemilu2026', 'color' => '#dc2626'],
            ['name' => 'AI', 'slug' => 'ai', 'color' => '#7c3aed'],
            ['name' => 'Startup', 'slug' => 'startup', 'color' => '#16a34a'],
            ['name' => 'Timnas', 'slug' => 'timnas', 'color' => '#2563eb'],
            ['name' => 'Crypto', 'slug' => 'crypto', 'color' => '#f59e0b'],
            ['name' => 'UMKM', 'slug' => 'umkm', 'color' => '#ea580c'],
            ['name' => 'PialaDunia2026', 'slug' => 'pialadunia2026', 'color' => '#0891b2'],
        ];

        foreach ($tags as $t) {
            Tag::create($t);
        }
    }
}