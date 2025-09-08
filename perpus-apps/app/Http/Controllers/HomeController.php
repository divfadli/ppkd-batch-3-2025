<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Borrows;
use App\Models\DetailBorrows;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Dashboard | Perpustakaan';
        $subtitle = 'Halaman Dashboard';

        $totalBooks = Books::count();
        $totalStock = Books::sum('stock');

        // detail_buku ada tidak buku yang sedang dipinjam, actual_return_date = null;
        // select * from detai_borrows join book on book.id = detail_books.id_book;
        // join borrows on borrows.id = detail_borrows.borrow_id WHERE actual_return_date = null;
        $borrowedBooks = DetailBorrows::with('book', 'borrow')->whereHas('borrow', function ($query) {
            $query->whereNull('actual_return_date');
        })->count();

        $returnedBooks = Borrows::where('status', 0)->whereNotNull('actual_return_date')->count();
        $notReturnedBooks = Borrows::where('status', 1)->whereNull('actual_return_date')->count();

        $fines = Borrows::with('member')->where('fine', '>', 0)->get();
        $totalFines = Borrows::sum('fine');

        return view('dashboard.index', compact('title', 'subtitle', 'totalBooks', 'totalStock', 'borrowedBooks', 'returnedBooks', 'notReturnedBooks', 'fines', 'totalFines'));
    }
}
