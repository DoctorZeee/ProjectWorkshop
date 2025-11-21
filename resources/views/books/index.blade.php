@extends('layouts.app')

@section('title', 'Book Catalog - Library System')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Book Catalog</h1>
            <p class="text-gray-400 text-lg">Explore our collection of books</p>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form method="GET" action="{{ route('books.index') }}" class="space-y-4">
                <!-- Search Bar -->
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Search by title, ISBN, or author..." 
                            class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition"
                        >
                    </div>
                    <button type="submit" class="px-8 py-3 bg-black text-white font-medium hover:bg-gray-800 transition">
                        Search
                    </button>
                </div>

                <!-- Filters -->
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <!-- Genre Filter -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Genre</label>
                        <select name="genre" class="w-full px-4 py-2 border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="">All Genres</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                        <select name="sort" class="w-full px-4 py-2 border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title</option>
                            <option value="published" {{ request('sort') == 'published' ? 'selected' : '' }}>Published Date</option>
                            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
                        </select>
                    </div>

                    <!-- Order -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Order</label>
                        <select name="order" class="w-full px-4 py-2 border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>

                    @if(request()->hasAny(['search', 'genre', 'sort', 'order']))
                        <a href="{{ route('books.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Books Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($books->isEmpty())
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No books found</h3>
                <p class="mt-2 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
            </div>
        @else
            <!-- Results Count -->
            <div class="mb-6 text-sm text-gray-600">
                Showing {{ $books->firstItem() }}-{{ $books->lastItem() }} of {{ $books->total() }} books
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($books as $book)
                    <a href="{{ route('books.show', $book) }}" class="group bg-white border border-gray-200 hover:border-black transition-all duration-200">
                        <!-- Book Cover -->
                        <div class="aspect-[3/4] bg-gray-100 overflow-hidden">
                            @if($book->cover_image)
                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Book Info -->
                        <div class="p-4">
                            <!-- Genre Badge -->
                            <span class="inline-block px-2 py-1 text-xs font-medium mb-2" style="background-color: {{ $book->genre->bg_color }}; color: {{ $book->genre->text_color }};">
                                {{ $book->genre->name }}
                            </span>

                            <!-- Title -->
                            <h3 class="font-bold text-lg mb-1 line-clamp-2 group-hover:text-gray-600 transition">
                                {{ $book->title }}
                            </h3>

                            <!-- Author -->
                            <p class="text-sm text-gray-600 mb-2">
                                by {{ $book->author->name }}
                            </p>

                            <!-- Price & Stock -->
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                                <span class="text-lg font-bold">
                                    ${{ number_format($book->price, 2) }}
                                </span>
                                <span class="text-xs {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $book->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $books->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection
