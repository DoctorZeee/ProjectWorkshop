<?php

namespace App\Http\Controllers;

use App\Enums\BorrowedStatus;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function activeBorrowings(Request $request)
    {
        $query = Transaction::with(['book.author', 'book.genre', 'user'])
            ->whereIn('status', [BorrowedStatus::Borrowed, BorrowedStatus::Delayed])
            ->orderBy('borrowed_date', 'desc');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('book', function ($q) use ($search) {
                    $q->where('title', 'ilike', "%{$search}%");
                })
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'ilike', "%{$search}%");
                });
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transactions = $query->paginate(15)->withQueryString();

        return view('transactions.active', compact('transactions'));
    }

    public function history(Request $request)
    {
        $query = Transaction::with(['book.author', 'book.genre', 'user'])
            ->orderBy('borrowed_date', 'desc');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('book', function ($q) use ($search) {
                    $q->where('title', 'ilike', "%{$search}%");
                })
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'ilike', "%{$search}%");
                });
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by Date Range
        if ($request->filled('from')) {
            $query->where('borrowed_date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->where('borrowed_date', '<=', $request->to);
        }

        $transactions = $query->paginate(20)->withQueryString();

        // Statistics
        $stats = [
            'total' => Transaction::count(),
            'borrowed' => Transaction::where('status', BorrowedStatus::Borrowed)->count(),
            'returned' => Transaction::where('status', BorrowedStatus::Returned)->count(),
            'delayed' => Transaction::where('status', BorrowedStatus::Delayed)->count(),
        ];

        return view('transactions.history', compact('transactions', 'stats'));
    }
}
