<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $news = News::where('is_published', true)->get();
        $users = User::all();

        $comments = [
            [
                'news_title' => 'Reformasi Ekonomi Digital: Peluang & Tantangan Baru 2026',
                'author_name' => 'Ahmad Fauzi',
                'author_email' => 'ahmad@example.com',
                'content' => 'Kebijakan yang bagus, semoga implementasinya juga baik di lapangan.',
                'status' => 'approved',
                'likes_count' => 12,
                'dislikes_count' => 1,
            ],
            [
                'news_title' => 'Reformasi Ekonomi Digital: Peluang & Tantangan Baru 2026',
                'author_name' => 'Sari Wulandari',
                'author_email' => 'sari@example.com',
                'content' => 'Perlu pengawasan ketat agar tidak ada penyalahgunaan.',
                'status' => 'approved',
                'likes_count' => 8,
                'dislikes_count' => 0,
            ],
            [
                'news_title' => 'Timnas Indonesia Cetak Sejarah Lolos ke Semifinal',
                'author_name' => 'Bambang Irawan',
                'author_email' => 'bambang@example.com',
                'content' => 'Garuda bisa! Ini sejarah yang sudah lama kita tunggu. Semoga di final juga bisa menang!',
                'status' => 'approved',
                'likes_count' => 45,
                'dislikes_count' => 2,
            ],
            [
                'news_title' => 'AI Generasi Baru Mampu Menulis Kode Sendiri',
                'author_name' => 'Rudi Hartono',
                'author_email' => 'rudi@example.com',
                'content' => 'Sebagai programmer, saya agak khawatir tapi juga excited. Kita harus adaptasi.',
                'status' => 'approved',
                'likes_count' => 23,
                'dislikes_count' => 3,
            ],
            [
                'news_title' => 'Bank Sentral Umumkan Suku Bunga Baru, Dampaknya pada Kredit',
                'author_name' => 'Linda Susanti',
                'author_email' => 'linda@example.com',
                'content' => 'Akhirnya cicilan KPR saya bisa turun sedikit. Lumayan buat budget bulanan.',
                'status' => 'pending',
                'likes_count' => 5,
                'dislikes_count' => 0,
            ],
            [
                'news_title' => 'Debat Capres 2026: Tiga Kandidat Saling Serang di Isu Ekonomi',
                'author_name' => 'Guest User',
                'author_email' => 'guest@example.com',
                'content' => 'SPAM: Kunjungi website kami untuk hadiah gratis!!!',
                'status' => 'rejected',
                'likes_count' => 0,
                'dislikes_count' => 15,
            ],
        ];

        foreach ($comments as $c) {
            $targetNews = News::where('title', $c['news_title'])->first();
            if (!$targetNews) continue;

            Comment::create([
                'news_id' => $targetNews->id,
                'user_id' => $users->random()->id,
                'author_name' => $c['author_name'],
                'author_email' => $c['author_email'],
                'content' => $c['content'],
                'status' => $c['status'],
                'likes_count' => $c['likes_count'],
                'dislikes_count' => $c['dislikes_count'],
            ]);
        }
    }
}