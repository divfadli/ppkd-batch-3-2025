<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ORM (Object Relation Model)
        // Prisma js, Sequilize js, dll
        $datas = Rooms::with('category')->orderByDesc('id')->get();
        $title = "Data Kamar";
        return view('layout.rooms.index', compact('datas','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::get();
        $title = 'Tambah Kamar';
        return view('layout.rooms.form', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'facility' => $request->facility,
            'description' =>$request->description
        ];

        // jika gambar sudah ada
        if ($request->hasFile('image_cover')) {
            $data['image_cover'] = $request->file('image_cover')->store('room', 'public');
        }

        Rooms::create($data);
        return redirect()->to('rooms')->with('success', 'Data Kategori Kamar Berhasil ditambahkan');
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
        $rooms = Rooms::with('category')->find($id);
        $categories = Categories::get();
        $title = "Ubah Kategori Kamar";
        return view('layout.rooms.form', compact('rooms', 'title','categories'));
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
}