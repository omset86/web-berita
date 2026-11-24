@extends('layouts.app')

@section('title', 'Pencarian: ' . ($query ?? '') . ' - BeritaKita')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Hasil Pencarian</h1>
    <p class="text-gray-600">
        Menampilkan hasil untuk kata kunci: <span class="text-primary-600 font-bold">"{{ $query }}"</span>
        <span class="text-gray-400">({{ $news->total() }} berita ditemukan)</span>
    </p>
</div>

<div class="grid lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Search Form (Agar user bisa search ulang dari sini) -->
        <form action="{{ route('search') }}" method="GET" class="mb-6 flex gap-2">
            <input type="text" name="q" value="{{ $query }}" placeholder="Cari berita lain..." 
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
            <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-primary-700 transition">Cari</button>
        </form>

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
                <div class="text-6xl mb-4">🔍</div>
                <p class="text-gray-500 text-lg mb-2">Tidak ada berita yang cocok dengan "{{ $query }}".</p>
                <p class="text-gray-400 text-sm">Coba gunakan kata kunci lain atau cek ejaan Anda.</p>
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

    <!-- Sidebar -->
    <aside class="space-y-8">
        @php
            $trendingNews = \App\Models\News::published()->orderBy('view_count', 'desc')->take(5)->get();
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

        <!-- Ad Slot Sidebar -->
        @php $adSidebar = \App\Models\AdSlot::where('code', 'sidebar_main')->where('is_active', true)->first(); @endphp
        @if($adSidebar)
            <div class="bg-gray-100 p-4 rounded-lg text-center border border-dashed border-gray-300">
                {!! $adSidebar->html_content !!}
            </div>
        @endif
    </aside>
</div>
@endsection