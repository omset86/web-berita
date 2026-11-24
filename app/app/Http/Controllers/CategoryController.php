<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        $sort = $request->get('sort', 'terbaru');
        $tagSlug = $request->get('tag');

        $query = News::published()->with(['category', 'author', 'tags']);

        // Filter Kategori
        if ($slug) {
            $query->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }

        // Filter Tag
        if ($tagSlug) {
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        // Sorting
        match ($sort) {
            'terpopuler' => $query->orderBy('view_count', 'desc'),
            'terlama' => $query->orderBy('published_at', 'asc'),
            default => $query->orderBy('published_at', 'desc'), // terbaru
        };

        $news = $query->paginate(9)->withQueryString();
        
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $popularTags = Tag::inRandomOrder()->take(5)->get();
        $currentCategory = $slug ? Category::where('slug', $slug)->first() : null;
        $currentTag = $tagSlug ? Tag::where('slug', $tagSlug)->first() : null;

        return view('category', compact(
            'news', 'categories', 'popularTags', 'sort', 
            'currentCategory', 'currentTag'
        ));
    }
}