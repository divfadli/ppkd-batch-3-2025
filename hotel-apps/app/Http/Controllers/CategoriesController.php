<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Categories::orderByDesc('id')->get();
        $title = "Kategori Kamar";
        return view('layout.categories.index', compact('datas','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori Kamar';
        return view('layout.categories.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Categories::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->to('categories')->with('success', 'Data Kategori Kamar Berhasil ditambahkan');
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
        // $category_room = Categories::where('id',$id)->first(); // cara lain dari pencarian 1 data
        $category_room = Categories::find($id);
        $title = "Ubah Kategori Kamar";
        return view('layout.categories.form', compact('category_room', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categories = Categories::find($id);
        $categories->name = $request->name;
        $categories->slug = Str::slug($request->name);
        $categories->save();
       
        return redirect()->to('categories')->with('success', 'Data Kategori Kamar Berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Categories::where('id',$id)->first()->delete(); //Cara lain delete 1 data
        Categories::find($id)->delete();
        return redirect()->to('categories')->with('success', 'Data Kategori Kamar Berhasil dihapus');
    }
}