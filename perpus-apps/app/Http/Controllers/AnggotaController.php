<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manage Anggota | Perpustakaan';
        $subtitle = 'Halaman Manajemen Anggota Perpustakaan';
        $thirdtitle = 'List Anggota Perpustakaan';
        $breadcrumbs = [
            ['label' => 'Anggota', 'url' => null]
        ];

        $datas = Members::orderByDesc('id')->get();
        return view('anggota.index', compact('title', 'subtitle', 'thirdtitle', 'breadcrumbs', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Anggota | Perpustakaan';
        $subtitle = 'Halaman Tambah Anggota';
        $thirdtitle = 'Tambah Anggota';
        $breadcrumbs = [
            ['label' => 'Anggota', 'url' => url('anggota')],
            ['label' => 'Create', 'url' => null]
        ];

        $pref = 'MEMBER-';
        $today = Carbon::now()->format('dmy');
        $countDay = Members::whereDate('created_at', now()->toDateString())->count() + 1;
        $runningNumber  = str_pad($countDay, 5, '0', STR_PAD_LEFT);
        $memberCode = $pref . $today . "-" . $runningNumber;

        return view('anggota.create', compact('memberCode', 'title', 'subtitle', 'thirdtitle', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nomor_anggota' => ['required', 'unique:members'],
            'nik' => ['required', 'numeric'],
            'nama_anggota' => ['required'],
            'no_hp' => ['required', 'unique:members'],
            'email' => ['required', 'unique:members']
        ];

        $validators = Validator::make($request->all(), $rules);

        if ($validators->fails()) {
            return back()->withErrors($validators)->withInput();
        }

        Members::create([
            'nomor_anggota' => $request->nomor_anggota,
            'nik' => $request->nik,
            'nama_anggota' => $request->nama_anggota,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        // $validated = $request->validate([
        //     'nomor_anggota' => 'required|string|max:50|unique:members,nomor_anggota',
        //     'nik'           => 'required|string|max:20|unique:members,nik',
        //     'nama_anggota'  => 'required|string|max:100',
        //     'no_hp'         => 'nullable|string|max:15',
        //     'email'         => 'nullable|email|max:100|unique:members,email',
        // ]);



        // Members::create($validated);

        return redirect()->to('anggota')->with('success', 'Data berhasil ditambahkan');
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
        $edit = Members::find($id);
        $title = 'Edit Anggota | Perpustakaan';
        $subtitle = 'Halaman Edit Anggota';
        $thirdtitle = 'Edit Anggota';
        $breadcrumbs = [
            ['label' => 'Anggota', 'url' => url('anggota')],
            ['label' => 'Edit', 'url' => null]
        ];

        return view('anggota.edit', compact('edit', 'title', 'subtitle', 'thirdtitle', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Members::findOrFail($id);
        $rules = [
            'nomor_anggota' => [
                'required',
                Rule::unique('members')->ignore($member->id),
            ],
            'nik' => [
                'required',
                'numeric',
                Rule::unique('members')->ignore($member->id),
            ],
            'nama_anggota' => 'required|string|max:100',
            'no_hp' => [
                'required',
                Rule::unique('members')->ignore($member->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('members')->ignore($member->id),
            ],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $member->update($validator->validated());

        // $validated = $request->validate([
        //     'nomor_anggota' => 'required|string|max:50',
        //     'nik'           => 'required|string|max:20',
        //     'nama_anggota'  => 'required|string|max:100',
        //     'no_hp'         => 'nullable|string|max:15',
        //     'email'         => 'nullable|email|max:100',
        // ]);

        // $member->fill($request->all());

        // $member->nik = $request->nik;
        // $member->nama_anggota = $request->nama_anggota;
        // $member->no_hp = $request->no_hp;
        // $member->email = $request->email;
        // $member->save();

        // $member = Members::findOrFail($id);
        // $member->update($validated);

        return redirect()->to('anggota')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Members::withTrashed()->find($id)->forceDelete();
        return redirect()->route('anggota.index-restore')->with('success', 'Data Anggota Berhasil dihapus');
    }
    public function softDelete(string $id)
    {
        Members::find($id)->delete();
        return redirect()->to('anggota')->with('success', 'Data Anggota Berhasil dihapus');
    }

    public function indexRestore()
    {
        $title = 'Restore Anggota | Perpustakaan';
        $subtitle = 'Halaman Restore Anggota';
        $thirdtitle = 'Restore Anggota';
        $breadcrumbs = [
            ['label' => 'Anggota', 'url' => url('anggota')],
            ['label' => 'Restore', 'url' => null]
        ];
        $member_r = Members::onlyTrashed()->get();
        return view('anggota.restore', compact('member_r', 'title', 'subtitle', 'thirdtitle', 'breadcrumbs'));
    }
    public function restore(string $id)
    {
        $member = Members::withTrashed()->find($id);
        $member->restore();

        return redirect()->to('anggota');
    }
}