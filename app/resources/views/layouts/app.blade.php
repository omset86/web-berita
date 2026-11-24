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
            darkMode: 'class', // Aktifkan dark mode berbasis class
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
    
    <!-- Script Dark Mode & Mobile Menu -->
    <script>
        // Cek preferensi user saat load
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark')
                localStorage.theme = 'light'
            } else {
                document.documentElement.classList.add('dark')
                localStorage.theme = 'dark'
            }
        }
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans transition-colors duration-200">
    
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
    <header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-50 transition-colors">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-primary-700 dark:text-primary-500">
                    B<span class="text-gray-800 dark:text-gray-100">eritaKita</span>
                </a>
                
                <!-- Desktop Nav -->
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="hover:text-primary-600 font-medium transition">Home</a>
                    @foreach($categories ?? [] as $cat)
                        <a href="{{ route('category', $cat->slug) }}" class="hover:text-primary-600 font-medium transition">{{ $cat->name }}</a>
                    @endforeach
                </nav>

                <!-- Desktop Actions (Search, Dark Mode, Login) -->
                <div class="hidden md:flex items-center space-x-4">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Cari berita..." class="border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 text-gray-800 dark:text-gray-100">
                    </form>
                    <button onclick="toggleDarkMode()" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition" aria-label="Toggle Dark Mode">
                        <!-- Sun Icon (for Dark Mode) -->
                        <svg class="w-5 h-5 hidden dark:block text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <!-- Moon Icon (for Light Mode) -->
                        <svg class="w-5 h-5 block dark:hidden text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>
                    @auth
                        <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-sm font-medium text-primary-600">Dashboard</a>
                    @else
                        <a href="{{ route('filament.admin.auth.login') }}" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600">Login</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button & Dark Mode Toggle -->
                <div class="flex md:hidden items-center space-x-3">
                    <button onclick="toggleDarkMode()" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 hidden dark:block text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg class="w-5 h-5 block dark:hidden text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>
                    <button onclick="toggleMobileMenu()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <svg class="w-6 h-6 text-gray-800 dark:text-gray-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 py-4 px-4 space-y-4 transition-colors">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="q" placeholder="Cari berita..." class="w-full border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 text-gray-800 dark:text-gray-100">
            </form>
            <nav class="flex flex-col space-y-3">
                <a href="{{ route('home') }}" class="hover:text-primary-600 font-medium">Home</a>
                @foreach($categories ?? [] as $cat)
                    <a href="{{ route('category', $cat->slug) }}" class="hover:text-primary-600 font-medium">{{ $cat->name }}</a>
                @endforeach
            </nav>
            <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                @auth
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="block text-sm font-medium text-primary-600">Dashboard Admin</a>
                @else
                    <a href="{{ route('filament.admin.auth.login') }}" class="block text-sm font-medium text-gray-600 dark:text-gray-300">Login Admin</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6 md:py-8 min-h-screen">
        @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-black text-gray-300 py-12 transition-colors">
        <div class="container mx-auto px-4 grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold text-white mb-4">BeritaKita</h3>
                <p class="text-sm text-gray-400">{{ $settings->footer_about ?? 'Portal berita independen yang menyajikan informasi akurat, cepat, dan berimbang.' }}</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Link Berguna</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Redaksi</a></li>
                    <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                    <li><a href="#" class="hover:text-white transition">Karier</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Legal</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white transition">Pedoman Media Siber</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4">Ikuti Kami</h4>
                <div class="flex space-x-4 text-sm">
                    <a href="{{ $settings->social_facebook ?? '#' }}" class="hover:text-white transition">Facebook</a>
                    <a href="{{ $settings->social_twitter ?? '#' }}" class="hover:text-white transition">Twitter</a>
                    <a href="{{ $settings->social_instagram ?? '#' }}" class="hover:text-white transition">Instagram</a>
                </div>
                <p class="mt-4 text-xs text-gray-500">&copy; {{ date('Y') }} BeritaKita. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>