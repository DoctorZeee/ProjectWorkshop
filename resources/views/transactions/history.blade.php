@extends('layouts.app')

@section('title', 'Borrowing History - Library System')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Borrowing History</h1>
            <p class="text-gray-400 text-lg">Complete archive of all library transactions</p>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total -->
                <div class="bg-gray-50 border border-gray-200 p-6">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Total Transactions</div>
                    <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['total']) }}</div>
                </div>

                <!-- Borrowed -->
                <div class="bg-blue-50 border border-blue-200 p-6">
                    <div class="text-sm font-medium text-blue-700 uppercase tracking-wider mb-2">Currently Borrowed</div>
                    <div class="text-3xl font-bold text-blue-900">{{ number_format($stats['borrowed']) }}</div>
                </div>

                <!-- Returned -->
                <div class="bg-green-50 border border-green-200 p-6">
                    <div class="text-sm font-medium text-green-700 uppercase tracking-wider mb-2">Returned</div>
                    <div class="text-3xl font-bold text-green-900">{{ number_format($stats['returned']) }}</div>
                </div>

                <!-- Delayed -->
                <div class="bg-yellow-50 border border-yellow-200 p-6">
                    <div class="text-sm font-medium text-yellow-700 uppercase tracking-wider mb-2">Delayed</div>
                    <div class="text-3xl font-bold text-yellow-900">{{ number_format($stats['delayed']) }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form method="GET" action="{{ route('borrowings.history') }}" class="space-y-4">
                <!-- Search Bar -->
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Search by book title or borrower name..." 
                            class="w-full px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition"
                        >
                    </div>
                    <button type="submit" class="px-8 py-3 bg-black text-white font-medium hover:bg-gray-800 transition">
                        Search
                    </button>
                </div>

                <!-- Filters -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="">All Status</option>
                            <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                            <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                            <option value="delayed" {{ request('status') == 'delayed' ? 'selected' : '' }}>Delayed</option>
                        </select>
                    </div>

                    <!-- Date From -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                        <input 
                            type="date" 
                            name="from" 
                            value="{{ request('from') }}"
                            class="w-full px-4 py-2 border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition"
                        >
                    </div>

                    <!-- Date To -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                        <input 
                            type="date" 
                            name="to" 
                            value="{{ request('to') }}"
                            class="w-full px-4 py-2 border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition"
                        >
                    </div>

                    @if(request()->hasAny(['search', 'status', 'from', 'to']))
                        <div class="flex items-end">
                            <a href="{{ route('borrowings.history') }}" class="w-full px-6 py-2 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition text-center">
                                Clear Filters
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Transactions List -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($transactions->isEmpty())
            <div class="text-center py-16 bg-white border border-gray-200">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No transactions found</h3>
                <p class="mt-2 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
            </div>
        @else
            <!-- Results Count -->
            <div class="mb-6 text-sm text-gray-600">
                Showing {{ $transactions->firstItem() }}-{{ $transactions->lastItem() }} of {{ $transactions->total() }} transactions
            </div>

            <!-- Transactions Table -->
            <div class="bg-white border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrower</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Returned Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fine</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($transactions as $transaction)
                                <tr class="hover:bg-gray-50 transition">
                                    <!-- Book -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-16 w-12 bg-gray-100 border border-gray-200">
                                                @if($transaction->book->cover_image)
                                                    <img src="{{ Storage::url($transaction->book->cover_image) }}" alt="{{ $transaction->book->title }}" class="h-full w-full object-cover">
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <a href="{{ route('books.show', $transaction->book) }}" class="text-sm font-medium text-gray-900 hover:text-gray-600 transition">
                                                    {{ Str::limit($transaction->book->title, 40) }}
                                                </a>
                                                <div class="text-sm text-gray-500">by {{ $transaction->book->author->name }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Borrower -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $transaction->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $transaction->user->email }}</div>
                                    </td>

                                    <!-- Borrowed Date -->
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $transaction->borrowed_date->format('M d, Y') }}
                                    </td>

                                    <!-- Duration -->
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $transaction->borrowed_for }} days
                                    </td>

                                    <!-- Returned Date -->
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        @if($transaction->returned_date)
                                            {{ $transaction->returned_date->format('M d, Y') }}
                                        @else
                                            <span class="text-gray-400">Not returned</span>
                                        @endif
                                    </td>

                                    <!-- Fine -->
                                    <td class="px-6 py-4 text-sm">
                                        @if($transaction->fine > 0)
                                            <span class="font-medium text-red-600">${{ number_format($transaction->fine) }}</span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        @if($transaction->status->value === 'borrowed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">
                                                Borrowed
                                            </span>
                                        @elseif($transaction->status->value === 'returned')
                                            <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800">
                                                Returned
                                            </span>
                                        @elseif($transaction->status->value === 'delayed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Delayed
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
</div>
@endsection
