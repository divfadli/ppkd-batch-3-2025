<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use App\Models\Locations;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manage Books | Perpustakaan';
        $subtitle = 'Halaman Manajemen Buku Perpustakaan';
        $thirdtitle = 'List Buku Perpustakaan';
        $breadcrumbs = [
            ['label' => 'Kategori Buku', 'url' => null]
        ];

        $datas = Books::with(['location', 'category'])
            ->latest('id')
            ->get();
        return view('buku.index', compact('title', 'subtitle','thirdtitle', 'breadcrumbs','datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title       = 'Tambah Buku | Perpustakaan';
        $subtitle    = 'Form Tambah Buku';
        $thirdtitle  = 'Tambah Buku';
        $breadcrumbs = [
            ['label' => 'Buku', 'url' => route('buku.index')],
            ['label' => 'Tambah Buku', 'url' => null],
        ];

        $locations   = Locations::all();
        $categories  = Categories::all();

        return view('buku.create', compact(
            'title',
            'subtitle',
            'thirdtitle',
            'breadcrumbs',
            'locations',
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'location_id'      => 'required|exists:locations,id',
            'category_id'      => 'required|exists:categories,id',
            'author'           => 'nullable|string|max:255',
            'publisher'        => 'nullable|string|max:255',
            'date_publication' => 'nullable|date',
            'description'      => 'nullable|string',
            'stock'            => 'nullable|integer|min:0',
        ]);

        Books::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title       = 'Edit Buku | Perpustakaan';
        $subtitle    = 'Form Edit Buku';
        $thirdtitle  = 'Edit Buku';
        $breadcrumbs = [
            ['label' => 'Buku', 'url' => route('buku.index')],
            ['label' => 'Edit Buku', 'url' => null],
        ];

        $book       = Books::findOrFail($id);
        $locations  = Locations::all();
        $categories = Categories::all();

        return view('buku.edit', compact(
            'title',
            'subtitle',
            'thirdtitle',
            'breadcrumbs',
            'book',
            'locations',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Books::findOrFail($id);

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'location_id'      => 'required|exists:locations,id',
            'category_id'      => 'required|exists:categories,id',
            'author'           => 'nullable|string|max:255',
            'publisher'        => 'nullable|string|max:255',
            'date_publication' => 'nullable|date',
            'description'      => 'nullable|string',
            'stock'            => 'nullable|integer|min:0',
        ]);

        $book->update($validated);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Books::findOrFail($id);

        try {
            $book->delete();
            return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('buku.index')->with('error', 'Gagal menghapus buku. Silakan coba lagi.');
        }
    }
}