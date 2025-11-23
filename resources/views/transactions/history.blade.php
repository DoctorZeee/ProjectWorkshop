@extends('layouts.app')

@section('title', 'Borrowing History - Library')

@section('content')
<!-- Hero Section -->
<section class="hero-pattern text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl font-bold mb-4">Borrowing History</h1>
            <p class="text-gray-300 text-lg">Complete archive of all library transactions</p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 -mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl p-6 shadow-md card-hover">
                <p class="text-gray-600 text-sm font-medium mb-2">TOTAL TRANSACTIONS</p>
                <p class="text-4xl font-bold text-gray-900">10</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-6 shadow-md card-hover">
                <p class="text-blue-700 text-sm font-medium mb-2">CURRENTLY BORROWED</p>
                <p class="text-4xl font-bold text-blue-700">0</p>
            </div>
            <div class="bg-green-50 rounded-xl p-6 shadow-md card-hover">
                <p class="text-green-700 text-sm font-medium mb-2">RETURNED</p>
                <p class="text-4xl font-bold text-green-700">10</p>
            </div>
            <div class="bg-yellow-50 rounded-xl p-6 shadow-md card-hover">
                <p class="text-yellow-700 text-sm font-medium mb-2">DELAYED</p>
                <p class="text-4xl font-bold text-yellow-700">0</p>
            </div>
        </div>
    </div>
</section>

<!-- Search and Filter Section -->
<section class="py-8 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <div class="flex-1">
                <input type="text" 
                    placeholder="Search by book title or borrower name..." 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <button class="bg-gray-900 text-white px-8 py-3 rounded-lg hover:bg-gray-800 transition font-medium">
                Search
            </button>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option>All Status</option>
                    <option>Returned</option>
                    <option>Borrowed</option>
                    <option>Delayed</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                <input type="date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                <input type="date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
        </div>
    </div>
</section>

<!-- History Table Section -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-gray-600 mb-6">Showing 1-10 of 10 transactions</p>
        
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Book</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Borrower</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Borrowed Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Returned Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fine</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Row 1 -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-12 w-10 bg-gray-200 rounded flex items-center justify-center mr-3">
                                        <i class="fas fa-book text-gray-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Teagan Mayer</p>
                                        <p class="text-sm text-gray-600">by Salvador Mueller</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">Kali Kiehn PhD</p>
                                <p class="text-sm text-gray-600">lokuneva@example.org</p>
                            </td>
                            <td class="px-6 py-4 text-gray-700">Nov 21, 2025</td>
                            <td class="px-6 py-4 text-gray-700">25 days</td>
                            <td class="px-6 py-4 text-gray-700">Nov 30, 2025</td>
                            <td class="px-6 py-4 text-gray-700">-</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Returned
                                </span>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-12 w-10 bg-gray-200 rounded flex items-center justify-center mr-3">
                                        <i class="fas fa-book text-gray-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Teagan Mayer</p>
                                        <p class="text-sm text-gray-600">by Salvador Mueller</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">Kyla Koepp</p>
                                <p class="text-sm text-gray-600">qlabadie@example.com</p>
                            </td>
                            <td class="px-6 py-4 text-gray-700">Nov 21, 2025</td>
                            <td class="px-6 py-4 text-gray-700">27 days</td>
                            <td class="px-6 py-4 text-gray-700">Dec 15, 2025</td>
                            <td class="px-6 py-4 text-gray-700">-</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Returned
                                </span>
                            </td>
                        </tr>

                        <!-- Additional rows can be added here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection