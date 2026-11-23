<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'id' => 1,
            'site_name' => 'BeritaKita',
            'site_tagline' => 'Portal Berita Terkini',
            'ticker_text' => '🔴 BREAKING: Pemerintah umumkan kebijakan baru ekonomi digital | Timnas Indonesia lolos ke semifinal | Peluncuran AI terbaru minggu ini | Update cuaca: hujan deras di Jabodetabek',
            'ticker_enabled' => true,
            'location_text' => 'Jakarta, Indonesia',
            'footer_about' => 'BeritaKita adalah portal berita independen yang menyajikan informasi akurat, cepat, dan berimbang sejak 2018.',
            'footer_address' => 'Jl. Sudirman No. 123, Jakarta Pusat 10220, Indonesia',
            'footer_phone' => '+62 21 1234 5678',
            'footer_email' => 'redaksi@beritakita.id',
            'social_facebook' => 'https://facebook.com/beritakita',
            'social_twitter' => 'https://twitter.com/beritakita',
            'social_instagram' => 'https://instagram.com/beritakita',
            'social_youtube' => 'https://youtube.com/@beritakita',
            'meta_title' => 'BeritaKita — Portal Berita Terkini Indonesia',
            'meta_description' => 'Baca berita terkini seputar politik, ekonomi, olahraga, teknologi, dan hiburan dari redaksi BeritaKita.',
        ]);
    }
}