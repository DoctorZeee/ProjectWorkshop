<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home.index');
});

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

Route::get('/borrowings/active', [TransactionController::class, 'activeBorrowings'])->name('borrowings.active');
Route::get('/borrowings/history', [TransactionController::class, 'history'])->name('borrowings.history');
