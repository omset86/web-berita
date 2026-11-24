<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    /**
     * Menampilkan detail berita berdasarkan slug (Route Model Binding)
     */
    public function show(News $news)
    {
        // Jika berita belum dipublikasikan, tampilkan 404
        if (!$news->is_published) {
            abort(404);
        }

        // Tambahkan view count
        $news->incrementViewCount();

        // Load semua relasi yang dibutuhkan untuk halaman detail
        $news->load([
            'category', 
            'author', 
            'tags', 
            'approvedComments' => function ($query) {
                $query->with('user')->orderBy('created_at', 'desc');
            }
        ]);

        // Ambil 3 berita terkait dari kategori yang sama
        $relatedNews = News::published()
            ->where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}