@extends('layouts.app')

@section('title', $book->title . ' - Library')

@section('content')
<!-- Hero Section with Breadcrumb -->
<section class="hero-pattern text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-300 mb-8">
            <a href="/" class="hover:text-white transition">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('books.index') }}" class="hover:text-white transition">Catalog</a>
            <span class="mx-2">/</span>
            <span class="text-white">{{ $book->title }}</span>
        </nav>

        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4">Book Details</h1>
            <p class="text-gray-300 text-lg">Complete information about this book</p>
        </div>
    </div>
</section>

<!-- Book Detail Section -->
<section class="py-12 -mt-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 p-8">
                <!-- Book Cover - Left Side -->
                <div class="lg:col-span-2">
                    <div class="sticky top-24">
                        <div class="aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden border-2 border-gray-200 shadow-lg">
                            @if($book->cover_image)
                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-book text-gray-300 text-8xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Availability Card -->
                        <div class="mt-6 p-6 border-2 border-gray-200 rounded-lg bg-gradient-to-br from-gray-50 to-gray-100">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                    <i class="fas fa-info-circle mr-2"></i>Availability
                                </span>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold {{ $book->stock > 0 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    <i class="fas {{ $book->stock > 0 ? 'fa-check-circle' : 'fa-times-circle' }} mr-2"></i>
                                    {{ $book->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                            @if($book->stock > 0)
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-cubes text-purple-500 mr-3 text-xl"></i>
                                    <p class="font-medium">{{ $book->stock }} copies available</p>
                                </div>
                            @endif
                        </div>

                        <!-- Borrow Button -->
                        @if($book->stock > 0)
                        <button class="w-full mt-4 gradient-bg text-white px-6 py-4 rounded-lg hover:opacity-90 transition font-bold text-lg shadow-lg">
                            <i class="fas fa-book-reader mr-2"></i>Borrow This Book
                        </button>
                        @else
                        <button disabled class="w-full mt-4 bg-gray-300 text-gray-500 px-6 py-4 rounded-lg cursor-not-allowed font-bold text-lg">
                            <i class="fas fa-ban mr-2"></i>Not Available
                        </button>
                        @endif
                    </div>
                </div>

                <!-- Book Information - Right Side -->
                <div class="lg:col-span-3">
                    <!-- Genre Badge -->
                    <span class="inline-block px-4 py-2 text-sm font-bold rounded-full mb-4 shadow-sm" style="background-color: {{ $book->genre->bg_color }}; color: {{ $book->genre->text_color }};">
                        <i class="fas fa-tag mr-1"></i>{{ $book->genre->name }}
                    </span>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $book->title }}</h1>

                    <!-- Author -->
                    <p class="text-xl text-gray-600 mb-6">
                        by <span class="font-bold text-purple-600">{{ $book->author->name }}</span>
                    </p>

                    <!-- Price -->
                    <div class="mb-8 inline-block">
                        <div class="bg-gradient-to-r from-purple-100 to-blue-100 px-6 py-3 rounded-lg border-2 border-purple-200">
                            <span class="text-sm font-semibold text-gray-600 block mb-1">Price</span>
                            <span class="text-4xl font-bold text-purple-600">${{ number_format($book->price, 2) }}</span>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t-2 border-gray-200 my-8"></div>

                    <!-- Book Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-5 rounded-lg border border-purple-200">
                            <dt class="text-sm font-semibold text-purple-700 mb-2 uppercase tracking-wide">
                                <i class="fas fa-barcode mr-2"></i>ISBN
                            </dt>
                            <dd class="text-lg font-bold text-gray-900">{{ $book->isbn }}</dd>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-5 rounded-lg border border-blue-200">
                            <dt class="text-sm font-semibold text-blue-700 mb-2 uppercase tracking-wide">
                                <i class="fas fa-calendar-alt mr-2"></i>Published
                            </dt>
                            <dd class="text-lg font-bold text-gray-900">{{ $book->published->format('Y') }}</dd>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-5 rounded-lg border border-green-200">
                            <dt class="text-sm font-semibold text-green-700 mb-2 uppercase tracking-wide">
                                <i class="fas fa-building mr-2"></i>Publisher
                            </dt>
                            <dd class="text-lg font-bold text-gray-900">{{ $book->publisher->name }}</dd>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($book->description)
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-align-left text-purple-500 mr-3"></i>
                                Description
                            </h2>
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $book->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Author Info -->
                    <div class="border-t-2 border-gray-200 pt-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-user-edit text-purple-500 mr-3"></i>
                            About the Author
                        </h2>
                        <div class="bg-gradient-to-br from-purple-50 to-blue-50 p-6 rounded-lg border border-purple-200">
                            <div class="flex items-start space-x-4">
                                @if($book->author->avatar)
                                    <img src="{{ Storage::url($book->author->avatar) }}" alt="{{ $book->author->name }}" class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg">
                                @else
                                    <div class="w-20 h-20 rounded-full gradient-bg flex items-center justify-center border-4 border-white shadow-lg">
                                        <span class="text-2xl font-bold text-white">{{ substr($book->author->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="font-bold text-xl text-gray-900 mb-1">{{ $book->author->name }}</h3>
                                    @if($book->author->date_of_birth)
                                        <p class="text-sm text-purple-600 mb-3 font-medium">
                                            <i class="fas fa-birthday-cake mr-1"></i>
                                            Born {{ $book->author->date_of_birth->format('F d, Y') }}
                                        </p>
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
        </div>
    </div>
</section>

<!-- Related Books Section -->
@if($relatedBooks->isNotEmpty())
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">More in {{ $book->genre->name }}</h2>
                <p class="text-gray-600">Discover similar books you might enjoy</p>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($relatedBooks as $relatedBook)
                    <a href="{{ route('books.show', $relatedBook) }}" class="group bg-white rounded-xl shadow-md overflow-hidden card-hover">
                        <!-- Book Cover -->
                        <div class="aspect-[3/4] bg-gray-100 overflow-hidden">
                            @if($relatedBook->cover_image)
                                <img src="{{ Storage::url($relatedBook->cover_image) }}" alt="{{ $relatedBook->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-book text-gray-300 text-6xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Book Info -->
                        <div class="p-4">
                            <span class="inline-block px-3 py-1 text-xs font-bold rounded-full mb-2" style="background-color: {{ $relatedBook->genre->bg_color }}; color: {{ $relatedBook->genre->text_color }};">
                                {{ $relatedBook->genre->name }}
                            </span>
                            <h3 class="font-bold text-base mb-1 line-clamp-2 group-hover:text-purple-600 transition">
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
    </section>
@endif

<!-- Back Button Section -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('books.index') }}" class="inline-flex items-center px-8 py-4 bg-gray-900 text-white font-bold rounded-lg hover:bg-gray-800 transition shadow-lg">
            <i class="fas fa-arrow-left mr-3 text-lg"></i>
            Back to Catalog
        </a>
    </div>
</section>
@endsection