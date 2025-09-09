<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Borrows;
use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\Categories;
use App\Models\DetailBorrows;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage Books Borrow | Perpustakaan';
        $subtitle = 'Halaman Manajemen Peminjaman Buku Perpustakaan';
        $thirdtitle = 'List Peminjaman Buku Perpustakaan';
        $breadcrumbs = [
            ['label' => 'Peminjaman Buku', 'url' => null]
        ];

        $datas = Borrows::with('member', 'detailBorrows')->orderByDesc('id')->get();

        $titleDelete = "Hapus Transaksi";
        $text = "Yakin ingin menghapus transaksi ini?";
        confirmDelete($titleDelete, $text);
        return view('pinjam_buku.index', compact('title', 'subtitle', 'thirdtitle', 'breadcrumbs', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Books Borrow | Perpustakaan';
        $subtitle = 'Halaman Tambah Peminjaman Buku Perpustakaan';
        $thirdtitle = 'Tambah Peminjaman Buku Perpustakaan';
        $breadcrumbs = [
            ['label' => 'Peminjaman Buku', 'url' => url('transaction')],
            ['label' => 'Create', 'url' => null]
        ];

        // PJM-today-001
        $kode = "PJM";
        $today = Carbon::now()->format('Ymd');
        $prefix = $kode . "-" . $today;
        $lastTransaction = Borrows::whereDate('created_at', Carbon::today())->orderByDesc('id')->first();

        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction->trans_number, -3);
            $newNumber = str_pad($lastNumber + 1, 3, "0", STR_PAD_LEFT);
        } else {
            $newNumber = "001";
        }
        $trans_number = $prefix . $newNumber;

        $members = Members::get();
        $categories = Categories::get();

        return view('pinjam_buku.create', compact('title', 'subtitle', 'thirdtitle', 'breadcrumbs', 'members', 'categories', 'trans_number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $insertBorrow = Borrows::create(
                [
                    'anggota_id' => $request->anggota_id,
                    'trans_number' => $request->trans_number,
                    'return_date' => $request->return_date,
                    'note' => $request->note,
                ]
            );
            foreach ($request->books_id as $val) {
                $book = Books::find($val);

                if (!$book || $book->stock <= 0) {
                    throw new \Exception("Stok buku '{$book->title}' habis!");
                }

                // Kurangi stok
                $book->decrement('stock', 1);

                // Baru simpan detail peminjaman
                DetailBorrows::create([
                    'borrows_id' => $insertBorrow->id,
                    'books_id'   => $val
                ]);
            }
            DB::commit();
            Alert::success('Berhasil!!', 'Transaksi berhasil dibuat');

            // return redirect()->to("print-trans/{$insertBorrow->id}");
            return redirect()->route("print-trans", ['id' => $insertBorrow->id]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error!!', $th->getMessage());
            return redirect()->to('transaction');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $borrow = Borrows::with('member', 'detailBorrows.book')->find($id);
        return view('pinjam_buku.show', compact('borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $borrow = Borrows::findOrFail($id);

            // Kembalikan stok buku sebelum hapus
            foreach ($borrow->detailBorrows as $detail) {
                $book = $detail->book;
                if ($book) {
                    $book->increment('stock', 1); // langsung simpan di DB
                }
            }

            $borrow->detailBorrows()->delete();
            $borrow->delete();

            DB::commit();
            Alert::success('Berhasil!', 'Transaksi berhasil dihapus');
            return redirect()->route('transaction.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error!', 'Gagal menghapus transaksi: ' . $th->getMessage());
            return redirect()->route('transaction.index');
        }
    }


    public function getBukuByidCategory($id)
    {
        try {
            $books = Books::where('category_id', $id)->where('stock', '>', 0)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'fetch book success',
                'data' => $books
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function print($id)
    {
        $borrow = Borrows::with('member', 'detailBorrows')->find($id);

        session()->reflash(); // biar alert ikut sampai ke index

        return view('pinjam_buku.print', compact('borrow'));
    }


    public function returnBook(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $borrow = Borrows::findOrFail($id);

            if (!$borrow->actual_return_date) {
                $borrow->actual_return_date = Carbon::now();
            }

            $returnDate = Carbon::parse($borrow->return_date)->startOfDay();
            $actualReturnDate = Carbon::parse($borrow->actual_return_date)->startOfDay();

            $fine = 0;
            if ($actualReturnDate->greaterThan($returnDate)) {
                $late = $returnDate->diffInDays($actualReturnDate);
                $fine = $late * 10000;
            }

            // Tambah stok buku kembali dan tersimpan ke DB
            foreach ($borrow->detailBorrows as $detail) {
                $book = $detail->book;
                if ($book) {
                    $book->increment('stock', 1); // langsung UPDATE ke DB
                }
            }

            $borrow->fine = $fine;
            $borrow->status = 0; // status: sudah dikembalikan
            $borrow->save();

            DB::commit();
            Alert::success('Berhasil', 'Buku Berhasil dikembalikan');
            return redirect()->to('transaction');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error!', 'Gagal mengembalikan buku: ' . $th->getMessage());
            return redirect()->to('transaction');
        }
    }
}
