<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manage Books Location | Perpustakaan';
        $subtitle = 'Halaman Manajemen Lokasi Buku Perpustakaan';
        $thirdtitle = 'List Lokasi Buku Perpustakaan';
        $breadcrumbs = [
            ['label' => 'Lokasi Buku', 'url' => null]
        ];

        $datas = Locations::orderByDesc('id')->get();
        return view('lokasi.index', compact('title', 'subtitle', 'thirdtitle', 'breadcrumbs', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Lokasi Buku | Perpustakaan';
        $subtitle = 'Halaman Tambah Lokasi Buku';
        $thirdtitle = 'Tambah Lokasi Buku';
        $breadcrumbs = [
            ['label' => 'Lokasi Buku', 'url' => url('lokasi')],
            ['label' => 'Create', 'url' => null]
        ];

        // Generate code_location
        $prefix        = 'LOC-';
        // $today         = Carbon::now()->format('dmy');
        $countLocation = Locations::count() + 1; // hitung semua data, tambah 1
        $runningNumber = str_pad($countLocation, 3, '0', STR_PAD_LEFT);
        $codeLocation  = $prefix . $runningNumber;

        // Generate bookshelf (default otomatis)
        $totalLocations = Locations::count() + 1;
        $nextNumber = str_pad($totalLocations, 1, '0', STR_PAD_LEFT);
        $bookshelf = "Rak-{$nextNumber}, Lantai-{$nextNumber}";


        return view('lokasi.create', compact('codeLocation', 'bookshelf', 'title', 'subtitle', 'thirdtitle', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'code_location' => ['required', 'unique:locations'],
            'label' => ['required'],
            'bookshelf' => ['required', 'unique:locations']
        ];

        $validators = Validator::make($request->all(), $rules);

        if ($validators->fails()) {
            return back()->withErrors($validators)->withInput();
        }

        Locations::create([
            'code_location' => $request->code_location,
            'label' => $request->label,
            'bookshelf' => $request->bookshelf,
        ]);

        return redirect()->to('lokasi')->with('success', 'Data berhasil ditambahkan');
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
        $edit = Locations::find($id);
        $title = 'Edit Lokasi Buku | Perpustakaan';
        $subtitle = 'Halaman Edit Lokasi Buku';
        $thirdtitle = 'Edit Lokasi Buku';
        $breadcrumbs = [
            ['label' => 'Lokasi Buku', 'url' => url('lokasi')],
            ['label' => 'Edit', 'url' => null]
        ];

        return view('lokasi.edit', compact('edit', 'title', 'subtitle', 'thirdtitle', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lokasi = Locations::findOrFail($id);
        $rules = [
            'code_location' => [
                'required',
                Rule::unique('locations')->ignore($lokasi->id),
            ],
            'label' => 'required|string',
            'bookshelf' => [
                'required',
                Rule::unique('locations')->ignore($lokasi->id),
            ]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $lokasi->update($validator->validated());

        return redirect()->to('lokasi')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Locations::find($id)->delete();
        return redirect()->to('lokasi')->with('success', 'Data Lokasi Buku Berhasil dihapus');
    }
}