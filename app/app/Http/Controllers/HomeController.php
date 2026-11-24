<?php

namespace App\Http\Controllers;

use App\Models\AdSlot;
use App\Models\Category;
use App\Models\LiveReport;
use App\Models\News;
use App\Models\Poll;
use App\Models\SiteSetting;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::get();
        
        $featuredNews = News::published()
            ->featured()
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        $latestNews = News::published()
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $trendingNews = News::published()
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $popularTags = Tag::inRandomOrder()->take(5)->get();
        $activePoll = Poll::where('is_active', true)->with('options')->first();
        $liveReports = LiveReport::where('is_published', true)
            ->orderBy('timestamp', 'desc')
            ->take(5)
            ->get();

        return view('home', compact(
            'settings', 'featuredNews', 'latestNews', 'trendingNews',
            'categories', 'popularTags', 'activePoll', 'liveReports'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        $news = News::published()
            ->where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->with(['category', 'author'])
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('search', compact('news', 'query'));
    }
}