<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['author', 'publisher', 'genre'])
            ->where('available', true);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'ilike', "%{$search}%")
                  ->orWhere('isbn', 'ilike', "%{$search}%")
                  ->orWhereHas('author', function ($q) use ($search) {
                      $q->where('name', 'ilike', "%{$search}%");
                  });
            });
        }

        // Filter by Genre
        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }

        // Sort
        $sortBy = $request->get('sort', 'title');
        $sortOrder = $request->get('order', 'asc');
        
        if (in_array($sortBy, ['title', 'price', 'published'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('title', 'asc');
        }

        $books = $query->paginate(12)->withQueryString();
        $genres = Genre::orderBy('name')->get();

        return view('books.index', compact('books', 'genres'));
    }

    public function show(Book $book)
    {
        $book->load(['author', 'publisher', 'genre']);
        
        // Related books (same genre, different book)
        $relatedBooks = Book::with(['author', 'genre'])
            ->where('genre_id', $book->genre_id)
            ->where('id', '!=', $book->id)
            ->where('available', true)
            ->limit(4)
            ->get();

        return view('books.show', compact('book', 'relatedBooks'));
    }
}
