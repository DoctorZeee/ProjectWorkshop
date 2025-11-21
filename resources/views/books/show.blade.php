@extends('layouts.app')

@section('title', $book->title . ' - Library System')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex text-sm text-gray-500">
                <a href="{{ route('books.index') }}" class="hover:text-gray-900 transition">Catalog</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">{{ $book->title }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Book Detail -->
        <div class="bg-white border border-gray-200 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 p-8">
                <!-- Book Cover - Left Side -->
                <div class="lg:col-span-2">
                    <div class="sticky top-24">
                        <div class="aspect-[3/4] bg-gray-100 overflow-hidden border border-gray-200">
                            @if($book->cover_image)
                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Availability -->
                        <div class="mt-6 p-4 border border-gray-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Availability</span>
                                <span class="inline-flex items-center px-3 py-1 text-sm font-medium {{ $book->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $book->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                            @if($book->stock > 0)
                                <p class="text-sm text-gray-600">{{ $book->stock }} copies available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Book Information - Right Side -->
                <div class="lg:col-span-3">
                    <!-- Genre Badge -->
                    <span class="inline-block px-3 py-1 text-sm font-medium mb-4" style="background-color: {{ $book->genre->bg_color }}; color: {{ $book->genre->text_color }};">
                        {{ $book->genre->name }}
                    </span>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $book->title }}</h1>

                    <!-- Author -->
                    <p class="text-xl text-gray-600 mb-6">
                        by <span class="font-medium text-gray-900">{{ $book->author->name }}</span>
                    </p>

                    <!-- Price -->
                    <div class="mb-8">
                        <span class="text-4xl font-bold text-gray-900">${{ number_format($book->price, 2) }}</span>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-8"></div>

                    <!-- Book Details -->
                    <div class="space-y-4 mb-8">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">ISBN</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $book->isbn }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Published</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $book->published->format('Y') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Publisher</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $book->publisher->name }}</dd>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($book->description)
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Description</h2>
                            <div class="prose prose-gray max-w-none">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $book->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Author Info -->
                    <div class="border-t border-gray-200 pt-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">About the Author</h2>
                        <div class="flex items-start space-x-4">
                            @if($book->author->avatar)
                                <img src="{{ Storage::url($book->author->avatar) }}" alt="{{ $book->author->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                            @else
                                <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center border-2 border-gray-300">
                                    <span class="text-xl font-bold text-gray-600">{{ substr($book->author->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-bold text-lg text-gray-900">{{ $book->author->name }}</h3>
                                @if($book->author->date_of_birth)
                                    <p class="text-sm text-gray-600 mb-2">Born {{ $book->author->date_of_birth->format('F d, Y') }}</p>
                                @endif
                                @if($book->author->bio)
                                    <p class="text-gray-700 leading-relaxed">{{ Str::limit($book->author->bio, 250) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Books -->
        @if($relatedBooks->isNotEmpty())
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">More in {{ $book->genre->name }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($relatedBooks as $relatedBook)
                        <a href="{{ route('books.show', $relatedBook) }}" class="group bg-white border border-gray-200 hover:border-black transition-all duration-200">
                            <!-- Book Cover -->
                            <div class="aspect-[3/4] bg-gray-100 overflow-hidden">
                                @if($relatedBook->cover_image)
                                    <img src="{{ Storage::url($relatedBook->cover_image) }}" alt="{{ $relatedBook->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Book Info -->
                            <div class="p-4">
                                <span class="inline-block px-2 py-1 text-xs font-medium mb-2" style="background-color: {{ $relatedBook->genre->bg_color }}; color: {{ $relatedBook->genre->text_color }};">
                                    {{ $relatedBook->genre->name }}
                                </span>
                                <h3 class="font-bold text-base mb-1 line-clamp-2 group-hover:text-gray-600 transition">
                                    {{ $relatedBook->title }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    by {{ $relatedBook->author->name }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-12">
            <a href="{{ route('books.index') }}" class="inline-flex items-center px-6 py-3 bg-black text-white font-medium hover:bg-gray-800 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Catalog
            </a>
        </div>
    </div>
</div>
@endsection
