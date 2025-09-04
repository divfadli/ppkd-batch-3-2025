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
            foreach ($request->books_id as $key => $val) {
                DetailBorrows::create([
                    'borrows_id' => $insertBorrow->id,
                    'books_id' => $request->books_id[$key]
                ]);
            }
            DB::commit();

            return redirect()->to('print-trans', $insertBorrow->id);
        } catch (\Throwable $th) {
            DB::rollBack();
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
        //
    }

    public function getBukuByidCategory($id)
    {
        try {
            $books = Books::where('category_id', $id)->get();
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
        return view('pinjam_buku.print', compact('borrow'));
    }
}