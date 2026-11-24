<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings->site_name ?? 'BeritaKita')</title>
    <meta name="description" content="@yield('meta_description', $settings->meta_description ?? 'Portal Berita Terkini')">
    
    <!-- Tailwind CDN + Custom Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50: '#eff6ff', 100: '#dbeafe', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 900: '#1e3a8a' },
                        danger: { 500: '#ef4444', 600: '#dc2626' },
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <!-- Breaking News Ticker -->
    @if(isset($settings) && $settings->ticker_enabled)
    <div class="bg-danger-600 text-white text-sm py-2 overflow-hidden whitespace-nowrap relative">
        <div class="container mx-auto px-4 flex items-center">
            <span class="font-bold bg-danger-700 px-2 py-1 rounded mr-3 flex-shrink-0 flex items-center gap-2">
                <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span> BREAKING
            </span>
            <marquee behavior="scroll" direction="left" class="flex-1">{{ $settings->ticker_text }}</marquee>
        </div>
    </div>
    @endif

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-primary-700">
                    B<span class="text-gray-800">eritaKita</span>
                </a>
                
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-primary-600 font-medium">Home</a>
                    @foreach($categories ?? [] as $cat)
                        <a href="{{ route('category', $cat->slug) }}" class="hover:text-primary-600 font-medium">{{ $cat->name }}</a>
                    @endforeach
                </nav>

                <div class="flex items-center space-x-4">
                    <form action="{{ route('search') }}" method="GET" class="hidden md:block">
                        <input type="text" name="q" placeholder="Cari berita..." class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </form>
                    @auth
                        <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-sm font-medium text-primary-600">Dashboard</a>
                    @else
                        <a href="{{ route('filament.admin.auth.login') }}" class="text-sm font-medium text-gray-600 hover:text-primary-600">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 min-h-screen">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-4 grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold text-white mb-4">BeritaKita</h3>
                <p class="text-sm">{{ $settings->footer_about ?? 'Portal berita independen yang menyajikan informasi akurat, cepat, dan berimbang.' }}</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Link Berguna</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white">Redaksi</a></li>
                    <li><a href="#" class="hover:text-white">Kontak</a></li>
                    <li><a href="#" class="hover:text-white">Karier</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white">Pedoman Media Siber</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="{{ $settings->social_facebook ?? '#' }}" class="hover:text-white">Facebook</a>
                    <a href="{{ $settings->social_twitter ?? '#' }}" class="hover:text-white">Twitter</a>
                    <a href="{{ $settings->social_instagram ?? '#' }}" class="hover:text-white">Instagram</a>
                </div>
                <p class="mt-4 text-xs text-gray-500">&copy; {{ date('Y') }} BeritaKita. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>