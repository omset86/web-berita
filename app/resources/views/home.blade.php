@extends('layouts.app')

@section('title', $settings->meta_title ?? 'BeritaKita - Portal Berita Terkini')

@section('content')
<!-- Hero / Headline -->
<section class="mb-10">
    <h2 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-primary-600 pl-3">Berita Unggulan</h2>
    <div class="grid md:grid-cols-2 gap-6">
        @foreach($featuredNews->take(2) as $index => $news)
        <a href="{{ route('news.show', $news->slug) }}" class="group relative rounded-xl overflow-hidden shadow-lg {{ $index === 0 ? 'md:row-span-2' : '' }}">
            <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=800&q=80' }}" 
                 alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 {{ $index === 0 ? 'h-96 md:h-full' : 'h-64' }}">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex flex-col justify-end p-6">
                <span class="bg-primary-600 text-white text-xs font-bold px-2 py-1 rounded w-max mb-2">{{ strtoupper($news->category->name) }}</span>
                <h3 class="text-white text-xl md:text-2xl font-bold leading-tight mb-2">{{ $news->title }}</h3>
                <p class="text-gray-200 text-sm line-clamp-2 mb-3">{{ $news->excerpt }}</p>
                <div class="flex items-center text-gray-300 text-xs space-x-3">
                    <span class="flex items-center gap-1">{!! render_icon('user', 'w-4 h-4') !!} {{ $news->author->name }}</span>
                    <span class="flex items-center gap-1">{!! render_icon('clock', 'w-4 h-4') !!} {{ $news->published_at->diffForHumans() }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>

<div class="grid lg:grid-cols-3 gap-8">
    <!-- Main Content: Berita Terbaru -->
    <div class="lg:col-span-2">
        <!-- Kategori & Sort Tabs -->
        <div class="flex flex-wrap items-center justify-between mb-6 border-b border-gray-200 pb-2">
            <div class="flex space-x-4 overflow-x-auto">
                <a href="{{ route('category') }}" class="text-primary-600 font-semibold border-b-2 border-primary-600 pb-2">Semua</a>
                @foreach($categories->take(5) as $cat)
                    <a href="{{ route('category', $cat->slug) }}" class="text-gray-600 hover:text-primary-600 font-medium pb-2">{{ $cat->name }}</a>
                @endforeach
            </div>
            <div class="flex items-center space-x-2 text-sm">
                <span class="text-gray-500">Urutkan:</span>
                <a href="{{ route('category', ['sort' => 'terbaru']) }}" class="text-primary-600 font-medium">Terbaru</a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('category', ['sort' => 'terpopuler']) }}" class="text-gray-600 hover:text-primary-600">Terpopuler</a>
            </div>
        </div>

        <!-- Tag Populer -->
        <div class="mb-6 flex flex-wrap gap-2">
            <span class="text-sm text-gray-500 py-1">Tag populer:</span>
            @foreach($popularTags as $tag)
                <a href="{{ route('category', ['tag' => $tag->slug]) }}" class="bg-gray-100 hover:bg-primary-100 text-gray-700 hover:text-primary-700 text-xs px-3 py-1 rounded-full transition">#{{ $tag->name }}</a>
            @endforeach
        </div>

        <!-- List Berita -->
        <div class="space-y-6">
            @foreach($latestNews as $news)
            <article class="flex flex-col md:flex-row gap-4 bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                <a href="{{ route('news.show', $news->slug) }}" class="md:w-1/3 flex-shrink-0">
                    <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=400&q=80' }}" class="w-full h-48 md:h-32 object-cover rounded-lg" alt="{{ $news->title }}">
                </a>
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <a href="{{ route('category', $news->category->slug) }}" class="text-primary-600 text-xs font-bold uppercase mb-1 block">{{ $news->category->name }}</a>
                        <a href="{{ route('news.show', $news->slug) }}" class="text-lg font-bold text-gray-900 hover:text-primary-600 mb-2 block">{{ $news->title }}</a>
                        <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ $news->excerpt }}</p>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <div class="flex items-center space-x-3">
                            <span class="flex items-center gap-1">{!! render_icon('user', 'w-4 h-4') !!} {{ $news->author->name }}</span>
                            <span class="flex items-center gap-1">{!! render_icon('clock', 'w-4 h-4') !!} {{ $news->published_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="flex items-center gap-1">{!! render_icon('thumb-up', 'w-4 h-4') !!} {{ $news->likes_count }}</span>
                            <span class="flex items-center gap-1">{!! render_icon('thumb-down', 'w-4 h-4') !!} {{ $news->dislikes_count }}</span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $latestNews->links('pagination::tailwind') }}
        </div>
    </div>

    <!-- Sidebar -->
    <aside class="space-y-8">
        <!-- Trending -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="text-danger-600">🔥</span> Trending
            </h3>
            <ol class="space-y-4">
                @foreach($trendingNews as $index => $news)
                <li class="flex gap-3 items-start">
                    <span class="text-2xl font-bold text-gray-200 leading-none">0{{ $index + 1 }}</span>
                    <a href="{{ route('news.show', $news->slug) }}" class="text-sm font-medium text-gray-800 hover:text-primary-600 leading-snug">
                        {{ $news->title }}
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