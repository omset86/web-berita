<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $authors = User::where('role', '!=', 'admin')->get();
        $categories = Category::all();
        $tags = Tag::all();

        $newsData = [
            [
                'title' => 'Reformasi Ekonomi Digital: Peluang & Tantangan Baru 2026',
                'excerpt' => 'Pemerintah meluncurkan paket kebijakan ekonomi digital yang diperkirakan mengubah lanskap bisnis nasional dalam 5 tahun ke depan.',
                'content' => '<p>JAKARTA — Pemerintah secara resmi mengumumkan paket kebijakan baru yang menyasar sektor ekonomi digital. Kebijakan ini mencakup insentif pajak untuk startup, kemudahan perizinan, dan program pelatihan talenta digital.</p><p>Menteri Ekonomi menyatakan bahwa kebijakan ini diharapkan mampu mendorong pertumbuhan ekonomi hingga 6% pada tahun 2027. "Ini adalah langkah strategis untuk memperkuat posisi Indonesia di kancah digital global," ujarnya dalam konferensi pers.</p><p>Selain itu, program ini juga menyasar UMKM agar dapat bertransformasi digital dengan pendampingan penuh dari pemerintah daerah. Anggaran yang disiapkan mencapai Rp 12 triliun untuk lima tahun ke depan.</p>',
                'category_slug' => 'ekonomi',
                'tag_slugs' => ['startup', 'umkm'],
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subHours(2),
                'view_count' => 12450,
                'likes_count' => 342,
                'dislikes_count' => 18,
                'reading_time' => 5,
            ],
            [
                'title' => 'Timnas Indonesia Cetak Sejarah Lolos ke Semifinal',
                'excerpt' => 'Kemenangan dramatis 2-1 atas Korea Selatan membawa Garuda ke babak semifinal untuk pertama kalinya dalam 20 tahun.',
                'content' => '<p>Stadion Gelora Bung Karno bergemuruh malam ini. Timnas Indonesia menuliskan sejarah baru dengan menaklukkan Korea Selatan 2-1 di babak perempat final.</p><p>Gol kemenangan dicetak di menit ke-89 melalui sundulan kepala striker muda yang baru berusia 19 tahun. Seluruh pemain langsung berlari ke sudut lapangan, memeluk satu sama lain sambil berlinang air mata.</p><p>Pelatih kepala menyatakan kebanggaannya: "Ini hasil kerja keras 2 tahun. Kami belum selesai, target kami adalah juara."</p>',
                'category_slug' => 'olahraga',
                'tag_slugs' => ['timnas', 'pialadunia2026'],
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subHours(3),
                'view_count' => 45200,
                'likes_count' => 1890,
                'dislikes_count' => 45,
                'reading_time' => 4,
            ],
            [
                'title' => 'AI Generasi Baru Mampu Menulis Kode Sendiri',
                'excerpt' => 'Perkembangan kecerdasan buatan terus mengejutkan: kini model AI dapat menciptakan perangkat lunak kompleks tanpa campur tangan manusia.',
                'content' => '<p>Model AI terbaru yang dirilis minggu ini mampu menghasilkan aplikasi full-stack hanya dari prompt teks. Developer di seluruh dunia bereaksi beragam — ada yang antusias, ada yang khawatir.</p><p>"Ini bukan pengganti programmer, tapi amplifier," kata salah satu peneliti. Namun serikat pekerja software engineer mulai menyuarakan kekhawatiran akan otomatisasi.</p>',
                'category_slug' => 'teknologi',
                'tag_slugs' => ['ai', 'startup'],
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subHours(4),
                'view_count' => 28900,
                'likes_count' => 720,
                'dislikes_count' => 95,
                'reading_time' => 6,
            ],
            [
                'title' => 'Konser Musik Terbesar Tahun Ini Segera Digelar',
                'excerpt' => 'Lebih dari 50 musisi papan atas akan tampil dalam festival 3 hari yang diprediksi menarik 200 ribu penonton.',
                'content' => '<p>Festival musik terbesar di Asia Tenggara kembali digelar di Jakarta. Line-up tahun ini disebut sebagai yang paling impresif sepanjang sejarah penyelenggaraan.</p>',
                'category_slug' => 'hiburan',
                'tag_slugs' => [],
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subHours(6),
                'view_count' => 15600,
                'likes_count' => 540,
                'dislikes_count' => 22,
                'reading_time' => 3,
            ],
            [
                'title' => 'Rupiah Menguat, IHSG Cetak Rekor Baru di Level 7.850',
                'excerpt' => 'Indeks Harga Saham Gabungan tembus rekor tertinggi sepanjang sejarah, didorong oleh sentimen positif kebijakan ekonomi baru.',
                'content' => '<p>Pasar modal Indonesia mencatatkan sejarah baru. IHSG ditutup di level 7.850, melampaui rekor sebelumnya yang tercipta di 2024.</p>',
                'category_slug' => 'ekonomi',
                'tag_slugs' => ['startup'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subHours(5),
                'view_count' => 8900,
                'likes_count' => 210,
                'dislikes_count' => 12,
                'reading_time' => 4,
            ],
            [
                'title' => 'Bank Sentral Umumkan Suku Bunga Baru, Dampaknya pada Kredit',
                'excerpt' => 'Keputusan ini diambil setelah rapat dewan gubernur yang berlangsung selama dua hari. Berikut dampak nyata bagi masyarakat.',
                'content' => '<p>Bank Indonesia mengumumkan penyesuaian suku bunga acuan. Analis memperkirakan dampaknya akan terasa pada kredit perumahan dan UMKM dalam 3 bulan ke depan.</p>',
                'category_slug' => 'ekonomi',
                'tag_slugs' => ['umkm'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subMinutes(30),
                'view_count' => 3200,
                'likes_count' => 24,
                'dislikes_count' => 2,
                'reading_time' => 5,
            ],
            [
                'title' => 'Piala Dunia 2026: Indonesia Siapkan Strategi Baru',
                'excerpt' => 'Pelatih kepala mengungkap formasi rahasia yang akan digunakan pada kualifikasi mendatang.',
                'content' => '<p>Menyongsong kualifikasi Piala Dunia 2026, Timnas Indonesia mempersiapkan strategi berbeda. Formasi 4-3-3 dengan pressing tinggi menjadi andalan.</p>',
                'category_slug' => 'olahraga',
                'tag_slugs' => ['timnas', 'pialadunia2026'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subHours(2),
                'view_count' => 19400,
                'likes_count' => 450,
                'dislikes_count' => 15,
                'reading_time' => 4,
            ],
            [
                'title' => 'Startup Lokal Raih Pendanaan Seri B Senilai Rp500 Miliar',
                'excerpt' => 'Perusahaan rintisan di bidang logistik ini menjadi unicorn baru Indonesia setelah pendanaan besar dari investor global.',
                'content' => '<p>Startup logistik berbasis AI berhasil menutup pendanaan Seri B senilai Rp500 miliar. Valuasi perusahaan kini menembus angka Rp15 triliun.</p>',
                'category_slug' => 'teknologi',
                'tag_slugs' => ['startup', 'ai'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subHour(),
                'view_count' => 6700,
                'likes_count' => 180,
                'dislikes_count' => 5,
                'reading_time' => 5,
            ],
            [
                'title' => 'Debat Capres 2026: Tiga Kandidat Saling Serang di Isu Ekonomi',
                'excerpt' => 'Debat pertama berlangsung panas. Masing-masing kandidat menawarkan visi berbeda untuk mengatasi inflasi dan pengangguran.',
                'content' => '<p>Jakarta Convention Center menjadi saksi debat capres pertama. Tiga pasangan calon saling beradu argumen terutama di isu ekonomi dan kesejahteraan.</p>',
                'category_slug' => 'politik',
                'tag_slugs' => ['pemilu2026'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subHours(8),
                'view_count' => 34500,
                'likes_count' => 890,
                'dislikes_count' => 120,
                'reading_time' => 7,
            ],
            [
                'title' => 'Program Vaksinasi Nasional Capai 95% Target',
                'excerpt' => 'Kementerian Kesehatan mengumumkan capaian vaksinasi telah melampaui target awal untuk kelompok rentan.',
                'content' => '<p>Program vaksinasi nasional berhasil mencapai 95% dari target yang ditetapkan. Capaian ini menempatkan Indonesia di jajaran negara dengan cakupan vaksinasi tertinggi di Asia.</p>',
                'category_slug' => 'kesehatan',
                'tag_slugs' => [],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'view_count' => 7800,
                'likes_count' => 320,
                'dislikes_count' => 18,
                'reading_time' => 4,
            ],
            [
                'title' => 'Kurikulum Merdeka 2.0 Diluncurkan untuk Semua Jenjang',
                'excerpt' => 'Kemendikbud merilis versi terbaru kurikulum dengan penekanan pada literasi digital dan karakter.',
                'content' => '<p>Kurikulum Merdeka 2.0 resmi diluncurkan. Perubahan utama terletak pada integrasi literasi digital di semua mata pelajaran.</p>',
                'category_slug' => 'pendidikan',
                'tag_slugs' => [],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'view_count' => 5400,
                'likes_count' => 210,
                'dislikes_count' => 30,
                'reading_time' => 5,
            ],
        ];

        foreach ($newsData as $data) {
            $category = Category::where('slug', $data['category_slug'])->first();
            $author = $authors->random();

            $news = News::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'content' => $data['content'],
                'image' => null, // akan diisi manual atau via Filament
                'category_id' => $category->id,
                'author_id' => $author->id,
                'is_featured' => $data['is_featured'],
                'is_published' => $data['is_published'],
                'published_at' => $data['published_at'],
                'view_count' => $data['view_count'],
                'likes_count' => $data['likes_count'],
                'dislikes_count' => $data['dislikes_count'],
                'reading_time' => $data['reading_time'],
                'meta_title' => $data['title'],
                'meta_description' => $data['excerpt'],
            ]);

            // Attach tags
            if (!empty($data['tag_slugs'])) {
                $tagIds = Tag::whereIn('slug', $data['tag_slugs'])->pluck('id');
                $news->tags()->attach($tagIds);
            }
        }
    }
}