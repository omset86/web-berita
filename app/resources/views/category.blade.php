@extends('layouts.app')

@section('title', ($currentCategory ? $currentCategory->name : 'Kategori') . ' - BeritaKita')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">
        {{ $currentCategory ? $currentCategory->name : 'Jelajahi Kategori' }}
    </h1>
    @if($currentTag)
        <p class="text-gray-600">Menampilkan berita dengan tag: <span class="text-primary-600 font-medium">#{{ $currentTag->name }}</span></p>
    @elseif($currentCategory)
        <p class="text-gray-600">{{ $currentCategory->description }}</p>
    @else
        <p class="text-gray-600">Temukan berita terkini dari berbagai kategori pilihan.</p>
    @endif
</div>

<div class="grid lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Filter Kategori & Sort -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('category', array_merge(request()->query(), ['tag' => null])) }}" 
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ !$currentCategory ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Semua
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('category', array_merge(request()->query(), ['tag' => null, 'slug' => $cat->slug])) }}" 
                           class="px-4 py-1.5 rounded-full text-sm font-medium transition {{ $currentCategory && $currentCategory->id === $cat->id ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
                
                <div class="flex items-center gap-2 text-sm border-l pl-4 border-gray-200">
                    <span class="text-gray-500">Urutkan:</span>
                    <a href="{{ route('category', array_merge(request()->query(), ['sort' => 'terbaru'])) }}" 
                       class="{{ ($sort ?? 'terbaru') === 'terbaru' ? 'text-primary-600 font-bold' : 'text-gray-600 hover:text-primary-600' }}">Terbaru</a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('category', array_merge(request()->query(), ['sort' => 'terpopuler'])) }}" 
                       class="{{ $sort === 'terpopuler' ? 'text-primary-600 font-bold' : 'text-gray-600 hover:text-primary-600' }}">Terpopuler</a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('category', array_merge(request()->query(), ['sort' => 'terlama'])) }}" 
                       class="{{ $sort === 'terlama' ? 'text-primary-600 font-bold' : 'text-gray-600 hover:text-primary-600' }}">Terlama</a>
                </div>
            </div>
        </div>

        <!-- Tag Populer -->
        <div class="mb-6 flex flex-wrap items-center gap-2">
            <span class="text-sm text-gray-500">Tag populer:</span>
            @foreach($popularTags as $tag)
                <a href="{{ route('category', array_merge(request()->query(), ['tag' => $tag->slug])) }}" 
                   class="bg-gray-100 hover:bg-primary-100 text-gray-700 hover:text-primary-700 text-xs px-3 py-1 rounded-full transition">
                    #{{ $tag->name }}
                </a>
            @endforeach
        </div>

        <!-- List Berita -->
        <div class="space-y-6">
            @forelse($news as $item)
            <article class="flex flex-col md:flex-row gap-4 bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                <a href="{{ route('news.show', $item->slug) }}" class="md:w-1/3 flex-shrink-0">
                    <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=400&q=80' }}" 
                         class="w-full h-48 md:h-32 object-cover rounded-lg" alt="{{ $item->title }}">
                </a>
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <a href="{{ route('category', $item->category->slug) }}" class="text-primary-600 text-xs font-bold uppercase mb-1 block">{{ $item->category->name }}</a>
                        <a href="{{ route('news.show', $item->slug) }}" class="text-lg font-bold text-gray-900 hover:text-primary-600 mb-2 block">{{ $item->title }}</a>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ $item->excerpt }}</p>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <div class="flex items-center space-x-3">
                            <span class="flex items-center gap-1">{!! render_icon('user', 'w-4 h-4') !!} {{ $item->author->name }}</span>
                            <span class="flex items-center gap-1">{!! render_icon('clock', 'w-4 h-4') !!} {{ $item->published_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="flex items-center gap-1">{!! render_icon('thumb-up', 'w-4 h-4') !!} {{ $item->likes_count }}</span>
                            <span class="flex items-center gap-1">{!! render_icon('thumb-down', 'w-4 h-4') !!} {{ $item->dislikes_count }}</span>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="bg-white p-12 rounded-lg shadow-sm text-center">
                <p class="text-gray-500 text-lg">Tidak ada berita ditemukan untuk filter ini.</p>
                <a href="{{ route('category') }}" class="text-primary-600 font-medium mt-2 inline-block hover:underline">Lihat semua berita</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($news->hasPages())
        <div class="mt-8">
            {{ $news->links('pagination::tailwind') }}
        </div>
        @endif
    </div>

    <!-- Sidebar (Sama seperti Home) -->
    <aside class="space-y-8">
        @php
            $trendingNews = \App\Models\News::published()->orderBy('view_count', 'desc')->take(5)->get();
            $activePoll = \App\Models\Poll::where('is_active', true)->with('options')->first();
            $liveReports = \App\Models\LiveReport::where('is_published', true)->orderBy('timestamp', 'desc')->take(5)->get();
        @endphp

        <!-- Trending -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="text-danger-600">🔥</span> Trending
            </h3>
            <ol class="space-y-4">
                @foreach($trendingNews as $index => $newsItem)
                <li class="flex gap-3 items-start">
                    <span class="text-2xl font-bold text-gray-200 leading-none">0{{ $index + 1 }}</span>
                    <a href="{{ route('news.show', $newsItem->slug) }}" class="text-sm font-medium text-gray-800 hover:text-primary-600 leading-snug">
                        {{ $newsItem->title }}
                    </a>
                </li>
                @endforeach
            </ol>
        </div>

        <!-- Polling -->
        @if($activePoll)
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 mb-4">🗳️ Polling</h3>
            <p class="text-sm font-medium mb-4">{{ $activePoll->question }}</p>
            <form action="{{ route('poll.vote') }}" method="POST" class="space-y-3">
                @csrf
                <input type="hidden" name="poll_id" value="{{ $activePoll->id }}">
                @foreach($activePoll->options as $option)
                <label class="flex items-center gap-2 text-sm cursor-pointer">
                    <input type="radio" name="option_id" value="{{ $option->id }}" class="text-primary-600 focus:ring-primary-500" required>
                    {{ $option->label }}
                </label>
                @endforeach
                <button type="submit" class="w-full bg-primary-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-primary-700 transition mt-2">Vote</button>
            </form>
        </div>
        @endif

        <!-- Live Report -->
        @if($liveReports->isNotEmpty())
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-danger-600">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-2 h-2 bg-danger-600 rounded-full animate-pulse"></span> Live Report
            </h3>
            <div class="space-y-4 relative">
                <div class="absolute left-2 top-2 bottom-2 w-0.5 bg-gray-200"></div>
                @foreach($liveReports as $report)
                <div class="relative pl-6">
                    <div class="absolute left-0 top-1.5 w-4 h-4 bg-white border-2 border-danger-600 rounded-full"></div>
                    <p class="text-xs text-gray-500 mb-1">{{ $report->timestamp->format('H:i') }}</p>
                    <p class="text-sm text-gray-800 font-medium">{{ $report->title }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Newsletter -->
        <div class="bg-primary-50 p-6 rounded-lg border border-primary-100">
            <h3 class="text-lg font-bold text-primary-900 mb-2">📬 Newsletter</h3>
            <p class="text-sm text-primary-700 mb-4">Dapatkan berita penting langsung di inbox Anda.</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
                @csrf
                <input type="email" name="email" placeholder="Alamat email Anda" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500" required>
                <button type="submit" class="w-full bg-primary-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-primary-700 transition">Berlangganan</button>
            </form>
        </div>
    </aside>
</div>
@endsection