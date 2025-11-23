@extends('layouts.app')

@section('title', 'Active Borrowings - Library')

@section('content')
<!-- Hero Section -->
<section class="hero-pattern text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4">Active Borrowings</h1>
            <p class="text-gray-300 text-lg">Books currently on loan</p>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="py-8 bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('borrowings.active') }}" class="space-y-4">
            <!-- Search Bar -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Search by book title or borrower name..." 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                    >
                </div>
                <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-bold rounded-lg hover:bg-gray-800 transition shadow-md">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
            </div>

            <!-- Filters -->
            <div class="flex flex-col md:flex-row gap-4 items-end">
                <!-- Status Filter -->
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-filter mr-1"></i>Status
                    </label>
                    <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                        <option value="">All Status</option>
                        <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                        <option value="delayed" {{ request('status') == 'delayed' ? 'selected' : '' }}>Delayed</option>
                    </select>
                </div>

                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('borrowings.active') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 font-bold rounded-lg hover:bg-gray-50 transition">
                        <i class="fas fa-times mr-2"></i>Clear Filters
                    </a>
                @endif
            </div>
        </form>
    </div>
</section>

<!-- Transactions List -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($transactions->isEmpty())
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <div class="flex justify-center mb-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-purple-100 to-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-book-reader text-purple-500 text-5xl"></i>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-3">No active borrowings</h2>
                <p class="text-gray-600 mb-8">There are currently no books on loan.</p>
                <a href="{{ route('books.index') }}" class="inline-block gradient-bg text-white px-8 py-3 rounded-lg hover:opacity-90 transition font-bold shadow-lg">
                    <i class="fas fa-search mr-2"></i>Browse Books
                </a>
            </div>
        @else
            <!-- Results Count -->
            <div class="mb-6 flex items-center justify-between">
                <p class="text-gray-600 font-medium">
                    <i class="fas fa-list mr-2 text-purple-500"></i>
                    Showing {{ $transactions->firstItem() }}-{{ $transactions->lastItem() }} of {{ $transactions->total() }} transactions
                </p>
            </div>

            <!-- Transactions Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-book mr-2 text-purple-500"></i>Book
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-user mr-2 text-blue-500"></i>Borrower
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-calendar-plus mr-2 text-green-500"></i>Borrowed Date
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-calendar-check mr-2 text-orange-500"></i>Due Date
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-hourglass-half mr-2 text-yellow-500"></i>Days Left
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-2 text-indigo-500"></i>Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($transactions as $transaction)
                                @php
                                    $dueDate = $transaction->borrowed_date->addDays($transaction->borrowed_for);
                                    $daysLeft = now()->diffInDays($dueDate, false);
                                    $isOverdue = $daysLeft < 0;
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <!-- Book -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-20 w-14 bg-gray-100 rounded-lg overflow-hidden border-2 border-gray-200 shadow-sm">
                                                @if($transaction->book->cover_image)
                                                    <img src="{{ Storage::url($transaction->book->cover_image) }}" alt="{{ $transaction->book->title }}" class="h-full w-full object-cover">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center">
                                                        <i class="fas fa-book text-gray-300 text-2xl"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <a href="{{ route('books.show', $transaction->book) }}" class="text-sm font-bold text-gray-900 hover:text-purple-600 transition">
                                                    {{ Str::limit($transaction->book->title, 40) }}
                                                </a>
                                                <div class="text-sm text-gray-600">by {{ $transaction->book->author->name }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Borrower -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $transaction->user->name }}</div>
                                        <div class="text-sm text-gray-600">{{ $transaction->user->email }}</div>
                                    </td>

                                    <!-- Borrowed Date -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $transaction->borrowed_date->format('M d, Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $transaction->borrowed_date->diffForHumans() }}
                                        </div>
                                    </td>

                                    <!-- Due Date -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ $dueDate->format('M d, Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $dueDate->diffForHumans() }}
                                        </div>
                                    </td>

                                    <!-- Days Left -->
                                    <td class="px-6 py-4">
                                        @if($isOverdue)
                                            <div class="inline-flex items-center px-3 py-2 rounded-lg bg-red-100 border border-red-200">
                                                <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                                                <span class="text-sm font-bold text-red-700">
                                                    {{ abs($daysLeft) }} days overdue
                                                </span>
                                            </div>
                                        @elseif($daysLeft <= 3)
                                            <div class="inline-flex items-center px-3 py-2 rounded-lg bg-yellow-100 border border-yellow-200">
                                                <i class="fas fa-clock text-yellow-600 mr-2"></i>
                                                <span class="text-sm font-bold text-yellow-700">
                                                    {{ $daysLeft }} days left
                                                </span>
                                            </div>
                                        @else
                                            <div class="inline-flex items-center px-3 py-2 rounded-lg bg-green-100 border border-green-200">
                                                <i class="fas fa-check-circle text-green-600 mr-2"></i>
                                                <span class="text-sm font-bold text-green-700">
                                                    {{ $daysLeft }} days left
                                                </span>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        @if($transaction->status->value === 'borrowed')
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold bg-blue-500 text-white shadow-sm">
                                                <i class="fas fa-book-reader mr-2"></i>Borrowed
                                            </span>
                                        @elseif($transaction->status->value === 'delayed')
                                            <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold bg-red-500 text-white shadow-sm">
                                                <i class="fas fa-exclamation-circle mr-2"></i>Delayed
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $transactions->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</section>
@endsection