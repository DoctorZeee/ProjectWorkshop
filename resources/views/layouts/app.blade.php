<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Library System')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 antialiased">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-black text-white border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('books.index') }}" class="flex items-center space-x-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="text-xl font-bold">Library</span>
                </a>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home.index') }}" class="text-sm font-medium hover:text-gray-300 transition {{ request()->routeIs('home.*') ? 'text-white' : 'text-gray-400' }}">
                        Home
                    </a>
                    <a href="{{ route('books.index') }}" class="text-sm font-medium hover:text-gray-300 transition {{ request()->routeIs('books.*') ? 'text-white' : 'text-gray-400' }}">
                        Catalog
                    </a>
                    <a href="{{ route('borrowings.active') }}" class="text-sm font-medium hover:text-gray-300 transition {{ request()->routeIs('borrowings.active') ? 'text-white' : 'text-gray-400' }}">
                        Active Borrowings
                    </a>
                    <a href="{{ route('borrowings.history') }}" class="text-sm font-medium hover:text-gray-300 transition {{ request()->routeIs('borrowings.history') ? 'text-white' : 'text-gray-400' }}">
                        History
                    </a>
                    <a href="#" class="text-sm font-medium text-gray-400 hover:text-gray-300 transition">
                        About
                    </a>
                </nav>

                <!-- Mobile menu button -->
                <button type="button" class="md:hidden p-2" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <a href="{{ route('books.index') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('books.*') ? 'text-white' : 'text-gray-400' }}">
                    Catalog
                </a>
                <a href="{{ route('borrowings.active') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('borrowings.active') ? 'text-white' : 'text-gray-400' }}">
                    Active Borrowings
                </a>
                <a href="{{ route('borrowings.history') }}" class="block py-2 text-sm font-medium {{ request()->routeIs('borrowings.history') ? 'text-white' : 'text-gray-400' }}">
                    History
                </a>
                <a href="#" class="block py-2 text-sm font-medium text-gray-400">
                    About
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-gray-400 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Library System</h3>
                    <p class="text-sm">A modern library management system with a sleek and simple interface.</p>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('books.index') }}" class="hover:text-white transition">Catalog</a></li>
                        <li><a href="{{ route('borrowings.active') }}" class="hover:text-white transition">Active Borrowings</a></li>
                        <li><a href="{{ route('borrowings.history') }}" class="hover:text-white transition">History</a></li>
                        <li><a href="#" class="hover:text-white transition">About</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Contact</h3>
                    <p class="text-sm">Email: library@example.com</p>
                    <p class="text-sm">Phone: (123) 456-7890</p>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-sm">
                <p>&copy; {{ date('Y') }} Library System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
