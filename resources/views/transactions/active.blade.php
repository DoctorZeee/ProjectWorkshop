@extends('layouts.app')

@section('title', 'Active Borrowings - Library System')

@section('content')
<div class="bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-black text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Active Borrowings</h1>
            <p class="text-gray-400 text-lg">Books currently on loan</p>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form method="GET" action="{{ route('borrowings.active') }}" class="space-y-4">
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
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <!-- Status Filter -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition">
                            <option value="">All Status</option>
                            <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                            <option value="delayed" {{ request('status') == 'delayed' ? 'selected' : '' }}>Delayed</option>
                        </select>
                    </div>

                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('borrowings.active') }}" class="px-6 py-2 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition">
                            Clear
                        </a>
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
                <h3 class="mt-4 text-lg font-medium text-gray-900">No active borrowings</h3>
                <p class="mt-2 text-sm text-gray-500">There are currently no books on loan.</p>
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Days Left</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
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

                                    <!-- Due Date -->
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $dueDate->format('M d, Y') }}
                                    </td>

                                    <!-- Days Left -->
                                    <td class="px-6 py-4">
                                        @if($isOverdue)
                                            <span class="text-sm font-medium text-red-600">
                                                {{ abs($daysLeft) }} days overdue
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-900">
                                                {{ $daysLeft }} days left
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        @if($transaction->status->value === 'borrowed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">
                                                Borrowed
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
