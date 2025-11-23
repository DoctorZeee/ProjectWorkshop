<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Library - Sistem Perpustakaan Digital')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        .hero-pattern {
            background-color: #1a202c;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234a5568' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-gray-900 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-book-open text-purple-400 text-2xl mr-3"></i>
                    <span class="text-white text-xl font-bold">Library</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-white hover:text-purple-400 transition font-medium {{ request()->is('/') ? 'text-purple-400' : 'text-gray-300' }}">Home</a>
                    <a href="/books" class="hover:text-purple-400 transition {{ request()->is('books*') ? 'text-purple-400' : 'text-gray-300' }}">Catalog</a>
                    <a href="/borrowings/active" class="hover:text-purple-400 transition {{ request()->is('borrowings/active*') ? 'text-purple-400' : 'text-gray-300' }}">Active Borrowings</a>
                    <a href="/borrowings/history" class="hover:text-purple-400 transition {{ request()->is('borrowings/history*') ? 'text-purple-400' : 'text-gray-300' }}">History</a>
                    <a href="#" class="text-gray-300 hover:text-purple-400 transition">About</a>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-300 hover:text-white transition">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <a href="{{ route('filament.admin.auth.login') }}"
                        class="gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition font-medium">
                        Login Admin
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content Section -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-book-open text-purple-400 text-2xl mr-3"></i>
                        <span class="text-xl font-bold">Library</span>
                    </div>
                    <p class="text-gray-400">
                        Sistem perpustakaan digital modern untuk kemudahan akses buku dan pembelajaran.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/" class="hover:text-purple-400 transition">Home</a></li>
                        <li><a href="/books" class="hover:text-purple-400 transition">Catalog</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">About</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Services</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-purple-400 transition">Book Borrowing</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Digital Library</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Reading Room</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Membership</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Jl. Perpustakaan No. 123</li>
                        <li><i class="fas fa-phone mr-2"></i>+62 123 4567 890</li>
                        <li><i class="fas fa-envelope mr-2"></i>info@library.com</li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-purple-400 transition">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-purple-400 transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-purple-400 transition">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Library System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>