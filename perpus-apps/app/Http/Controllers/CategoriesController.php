<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manage Books Category | Perpustakaan';
        $subtitle = 'Halaman Manajemen Kategori Buku Perpustakaan';
        $thirdtitle = 'List Kategori Buku Perpustakaan';
        $breadcrumbs = [
            ['label' => 'Kategori Buku', 'url' => null]
        ];

        $datas = Categories::orderByDesc('id')->get();
        return view('kategori_buku.index', compact('title', 'subtitle','thirdtitle', 'breadcrumbs','datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Book Category | Perpustakaan';
        $subtitle = 'Halaman Tambah Kategori Buku';
        $thirdtitle = 'Tambah Kategori Buku';
        $breadcrumbs = [
            ['label' => 'Kategori Buku', 'url' => url('kategori')],
            ['label' => 'Create', 'url' => null]
        ];
        
        return view('kategori_buku.create', compact('title', 'subtitle', 'thirdtitle','breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $rules = [
            'name_category' => ['required']
        ];

        $validators = Validator::make($request->all(), $rules);

        if ($validators->fails()) {
            return back()->withErrors($validators)->withInput();
        }

        Categories::create([ 
            'name_category' => $request->name_category, 
        ]);

        return redirect()->to('kategori')->with('success', 'Data berhasil ditambahkan');
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
        $edit = Categories::find($id);
        $title = 'Edit Book Category | Perpustakaan';
        $subtitle = 'Halaman Edit Kategori Buku';
        $thirdtitle = 'Edit Kategori Buku';
        $breadcrumbs = [
            ['label' => 'Kategori Buku', 'url' => url('kategori')],
            ['label' => 'Edit', 'url' => null]
        ];

        return view('kategori_buku.edit', compact('edit','title', 'subtitle', 'thirdtitle','breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cat = Categories::findOrFail($id);
        $rules = [
            'name_category' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $cat->update($validator->validated());

        return redirect()->to('kategori')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Categories::find($id)->delete();
        return redirect()->to('kategori')->with('success', 'Data Kategori Buku Berhasil dihapus');
    }
}