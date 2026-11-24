@extends('layouts.app')

@section('title', $news->meta_title ?? $news->title)
@section('meta_description', $news->meta_description ?? $news->excerpt)

@section('content')
<div class="grid lg:grid-cols-3 gap-8">
    <!-- Main Article -->
    <article class="lg:col-span-2 bg-white dark:bg-gray-800 p-4 md:p-8 rounded-xl shadow-sm transition-colors">
        <!-- Breadcrumb & Category -->
        <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-4">
            <a href="{{ route('home') }}" class="hover:text-primary-600">Home</a>
            <span>/</span>
            <a href="{{ route('category', $news->category->slug) }}" class="text-primary-600 font-medium">{{ $news->category->name }}</span>
        </div>

        <h1 class="text-2xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4 leading-tight">{{ $news->title }}</h1>

        <!-- Meta Info -->
        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
            <span class="flex items-center gap-1">{!! render_icon('user', 'w-4 h-4') !!} {{ $news->author->name }}</span>
            <span class="flex items-center gap-1">{!! render_icon('clock', 'w-4 h-4') !!} {{ $news->published_at->format('d M Y, H:i') }}</span>
            <span class="flex items-center gap-1">{!! render_icon('eye', 'w-4 h-4') !!} {{ number_format($news->view_count) }} dibaca</span>
            <span class="bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded text-xs">{{ $news->reading_time }} menit baca</span>
        </div>

        <!-- Featured Image -->
        @if($news->image)
        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-auto rounded-lg mb-8">
        @endif

        <!-- Content -->
        <div class="prose prose-lg dark:prose-invert max-w-none text-gray-800 dark:text-gray-300 mb-8">
            {!! $news->content !!}
        </div>

        <!-- Tags -->
        @if($news->tags->isNotEmpty())
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach($news->tags as $tag)
                <a href="{{ route('category', ['tag' => $tag->slug]) }}" class="bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 text-xs px-3 py-1 rounded-full hover:bg-primary-100 dark:hover:bg-primary-900/50">#{{ $tag->name }}</a>
            @endforeach
        </div>
        @endif

        <!-- Share Buttons -->
        <div class="flex items-center gap-3 mb-8">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Bagikan:</span>
            <button class="p-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">{!! render_icon('share', 'w-4 h-4') !!}</button>
            <button class="p-2 bg-sky-500 text-white rounded-full hover:bg-sky-600">X</button>
            <button class="p-2 bg-green-500 text-white rounded-full hover:bg-green-600">WA</button>
        </div>

        <!-- Multimedia Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-lg mb-8 transition-colors">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">🎧 Multimedia & Infografis</h3>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm text-center transition-colors">
                    <div class="text-3xl mb-2">🎙️</div>
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Podcast: Ngobrol Santai</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm text-center transition-colors">
                    <div class="text-3xl mb-2">📊</div>
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Infografis Data</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm text-center transition-colors">
                    <div class="text-3xl mb-2">📺</div>
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Video Behind The Scene</p>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="border-t border-gray-200 dark:border-gray-700 pt-8">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">💬 Komentar ({{ $news->approvedComments->count() }})</h3>
            
            <!-- Comment Form -->
            <form action="{{ route('comment.store') }}" method="POST" class="mb-8 bg-gray-50 dark:bg-gray-900/50 p-4 md:p-6 rounded-lg transition-colors">
                @csrf
                <input type="hidden" name="news_id" value="{{ $news->id }}">
                <div class="grid md:grid-cols-2 gap-4 mb-4">
                    <input type="text" name="author_name" placeholder="Nama Anda" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none" required>
                    <input type="email" name="author_email" placeholder="Email Anda" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none" required>
                </div>
                <textarea name="content" rows="4" placeholder="Tulis komentar Anda..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none mb-4" required></textarea>
                <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-primary-700 transition">Kirim Komentar</button>
            </form>

            <!-- Comments List -->
            <div class="space-y-6">
                @forelse($news->approvedComments as $comment)
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/50 rounded-full flex items-center justify-center text-primary-700 dark:text-primary-400 font-bold flex-shrink-0">
                        {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $comment->author_name }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 text-sm mb-2">{{ $comment->content }}</p>
                        <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                            <button class="flex items-center gap-1 hover:text-primary-600">{!! render_icon('thumb-up', 'w-4 h-4') !!} {{ $comment->likes_count }}</button>
                            <button class="flex items-center gap-1 hover:text-danger-600">{!! render_icon('thumb-down', 'w-4 h-4') !!} {{ $comment->dislikes_count }}</button>
                            <button class="hover:text-primary-600">Balas</button>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 dark:text-gray-400 text-sm italic">Belum ada komentar. Jadilah yang pertama!</p>
                @endforelse
            </div>
        </div>
    </article>

    <!-- Sidebar -->
    <aside class="space-y-8">
        <!-- Berita Terkait -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm transition-colors">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Berita Terkait</h3>
            <div class="space-y-4">
                @foreach($relatedNews as $related)
                <a href="{{ route('news.show', $related->slug) }}" class="flex gap-3 group">
                    <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=200&q=60' }}" class="w-20 h-20 object-cover rounded-lg flex-shrink-0" alt="{{ $related->title }}">
                    <div>
                        <h4 class="text-sm font-medium text-gray-800 dark:text-gray-200 group-hover:text-primary-600 leading-snug line-clamp-3">{{ $related->title }}</h4>
                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 block">{{ $related->published_at->diffForHumans() }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Ad Slot In-Article -->
        @php $adArticle = \App\Models\AdSlot::where('code', 'in_article')->where('is_active', true)->first(); @endphp
        @if($adArticle)
            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg text-center border border-dashed border-gray-300 dark:border-gray-600 transition-colors">
                {!! $adArticle->html_content !!}
            </div>
        @endif
    </aside>
</div>
@endsection