<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Hitung total buku
        $totalBooks = Book::count();
        
        // Hitung total users/anggota aktif
        $totalUsers = User::count();
        
        // Hitung total genre/kategori
        $totalGenres = Genre::count();
        
        // Hitung peminjaman bulan ini
        $borrowingsThisMonth = Transaction::whereMonth('borrowed_date', Carbon::now()->month)
            ->whereYear('borrowed_date', Carbon::now()->year)
            ->count();
        
        return view('home.index', compact(
            'totalBooks',
            'totalUsers',
            'totalGenres',
            'borrowingsThisMonth'
        ));
    }
}