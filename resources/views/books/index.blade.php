@extends('layouts.app')

@section('title', 'Book Catalog - Library')

@section('content')
<!-- Hero Section -->
<section class="hero-pattern text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4">Book Catalog</h1>
            <p class="text-gray-300 text-lg">Explore our collection of books</p>
        </div>
    </div>
</section>

<!-- Search and Filter Section -->
<section class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="flex-1">
                <input type="text" 
                    placeholder="Search by title, ISBN, or author..." 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <button class="bg-gray-900 text-white px-8 py-3 rounded-lg hover:bg-gray-800 transition font-medium">
                Search
            </button>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option>All Genres</option>
                    <option>Fiction</option>
                    <option>Non-Fiction</option>
                    <option>Science</option>
                    <option>History</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option>Title</option>
                    <option>Author</option>
                    <option>Year</option>
                    <option>Popularity</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option>Ascending</option>
                    <option>Descending</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Books Grid Section -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-gray-600 mb-6">Showing 1-4 of 4 books</p>
        
        <div class="grid md:grid-cols-4 gap-6">
            @foreach($books as $book)
            <!-- Book Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                <a href="{{ route('books.show', $book) }}">
                    <div class="h-64 bg-gray-200 flex items-center justify-center overflow-hidden">
                        @if($book->cover_image)
                            <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover hover:scale-110 transition duration-300">
                        @else
                            <i class="fas fa-book text-gray-400 text-6xl"></i>
                        @endif
                    </div>
                </a>
                <div class="p-6">
                    <span class="inline-block text-white text-xs px-3 py-1 rounded-full mb-3 font-bold" style="background-color: {{ $book->genre->bg_color }}; color: {{ $book->genre->text_color }};">
                        {{ $book->genre->name }}
                    </span>
                    <a href="{{ route('books.show', $book) }}">
                        <h3 class="font-bold text-lg mb-2 hover:text-purple-600 transition line-clamp-2">{{ $book->title }}</h3>
                    </a>
                    <p class="text-gray-600 text-sm mb-4">by {{ $book->author->name }}</p>
                    <a href="{{ route('books.show', $book) }}" class="block w-full gradient-bg text-white py-2 rounded-lg hover:opacity-90 transition font-medium text-center">
                        <i class="fas fa-eye mr-2"></i>View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection