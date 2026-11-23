<?php

namespace Database\Seeders;

use App\Models\LiveReport;
use App\Models\News;
use Illuminate\Database\Seeder;

class LiveReportSeeder extends Seeder
{
    public function run(): void
    {
        $news = News::where('title', 'like', '%Debat Capres%')->first();
        if (!$news) return;

        $events = [
            ['title' => 'Debat capres dimulai di Jakarta Convention Center', 'time' => now()->subMinutes(30), 'order' => 3],
            ['title' => 'Pendukung mulai memadati area debat', 'time' => now()->subMinutes(47), 'order' => 2],
            ['title' => 'Persiapan keamanan diperketat', 'time' => now()->subMinutes(72), 'order' => 1],
            ['title' => 'Tiga kandidat tiba di venue', 'time' => now()->subMinutes(90), 'order' => 0],
        ];

        foreach ($events as $e) {
            LiveReport::create([
                'title' => $e['title'],
                'content' => 'Update langsung dari lokasi: ' . $e['title'],
                'timestamp' => $e['time'],
                'news_id' => $news->id,
                'is_published' => true,
                'sort_order' => $e['order'],
            ]);
        }
    }
}