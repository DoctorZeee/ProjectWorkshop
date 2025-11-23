<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Sistem Perpustakaan Digital</title>
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
                    <a href="/" class="text-white hover:text-purple-400 transition font-medium">Home</a>
                    <a href="/books" class="text-gray-300 hover:text-purple-400 transition">Catalog</a>
                    <a href="/borrowings/active" class="text-gray-300 hover:text-purple-400 transition">Active Borrowings</a>
                    <a href="/borrowings/history" class="text-gray-300 hover:text-purple-400 transition">History</a>
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

    <!-- Hero Section -->
    <section class="hero-pattern text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-6 leading-tight">
                        Selamat Datang di<br>
                        <span class="text-purple-400">Perpustakaan Digital</span>
                    </h1>
                    <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                        Jelajahi ribuan koleksi buku dari berbagai genre. Pinjam buku favorit Anda dengan mudah dan cepat melalui sistem perpustakaan digital kami.
                    </p>
                    <div class="flex space-x-4">
                        <button class="gradient-bg px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition shadow-lg">
                            Mulai Jelajah
                        </button>
                        <button class="border-2 border-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition">
                            Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="relative">
                        <div class="absolute inset-0 bg-purple-500 rounded-2xl transform rotate-6 opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?w=600" alt="Library" class="relative rounded-2xl shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 -mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-6">
                <div class="stat-card rounded-xl p-6 text-center card-hover">
                    <i class="fas fa-book text-4xl text-purple-600 mb-3"></i>
                    <div class="text-3xl font-bold text-gray-800 mb-1">10,000+</div>
                    <div class="text-gray-600 font-medium">Total Buku</div>
                </div>
                <div class="stat-card rounded-xl p-6 text-center card-hover">
                    <i class="fas fa-users text-4xl text-blue-600 mb-3"></i>
                    <div class="text-3xl font-bold text-gray-800 mb-1">5,000+</div>
                    <div class="text-gray-600 font-medium">Anggota Aktif</div>
                </div>
                <div class="stat-card rounded-xl p-6 text-center card-hover">
                    <i class="fas fa-bookmark text-4xl text-green-600 mb-3"></i>
                    <div class="text-3xl font-bold text-gray-800 mb-1">50+</div>
                    <div class="text-gray-600 font-medium">Kategori</div>
                </div>
                <div class="stat-card rounded-xl p-6 text-center card-hover">
                    <i class="fas fa-exchange-alt text-4xl text-red-600 mb-3"></i>
                    <div class="text-3xl font-bold text-gray-800 mb-1">1,000+</div>
                    <div class="text-gray-600 font-medium">Peminjaman/Bulan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Nikmati kemudahan dalam mengakses dan meminjam buku dengan berbagai fitur yang kami sediakan
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-8 card-hover">
                    <div class="bg-purple-500 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-search text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Pencarian Mudah</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Cari buku berdasarkan judul, penulis, ISBN, atau kategori dengan sistem pencarian canggih kami.
                    </p>
                </div>
                
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-8 card-hover">
                    <div class="bg-blue-500 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Akses 24/7</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Akses katalog perpustakaan kapan saja, di mana saja melalui perangkat mobile atau desktop Anda.
                    </p>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-8 card-hover">
                    <div class="bg-green-500 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bell text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Notifikasi Otomatis</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dapatkan pengingat otomatis untuk pengembalian buku dan informasi koleksi buku terbaru.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=600" alt="About Library" class="rounded-2xl shadow-xl">
                </div>
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Tentang Perpustakaan Kami</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed text-lg">
                        Perpustakaan kami telah melayani masyarakat selama lebih dari 20 tahun, menyediakan akses ke berbagai koleksi buku, jurnal, dan materi pembelajaran lainnya.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                        Dengan sistem digital yang modern, kami berkomitmen untuk memberikan pengalaman peminjaman yang mudah, cepat, dan efisien bagi semua anggota.
                    </p>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                            <span class="text-gray-700 font-medium">Koleksi buku yang lengkap dan terupdate</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                            <span class="text-gray-700 font-medium">Ruang baca yang nyaman dan modern</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                            <span class="text-gray-700 font-medium">Staff yang ramah dan profesional</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Memulai?</h2>
            <p class="text-gray-200 text-lg mb-8">
                Daftarkan diri Anda sekarang dan mulai menikmati ribuan koleksi buku yang tersedia
            </p>
            <div class="flex justify-center space-x-4">
                <button class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                    Daftar Sekarang
                </button>
                <button onclick="window.location.href='/books';"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                    Lihat Katalog
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
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
                        <li><a href="#" class="hover:text-purple-400 transition">Home</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Catalog</a></li>
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
</body>
</html>