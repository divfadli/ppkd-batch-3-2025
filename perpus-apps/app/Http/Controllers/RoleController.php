<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Roles::orderByDesc('id')->get();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Roles::create([
            'name' => $request->name
        ]);
        Alert::success('Berhasil!!', 'Role berhasil dibuat');
        return redirect()->to('role');
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
        $edit = Roles::find($id);
        return view('role.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $roles = Roles::find($id);
        $roles->name = $request->name;
        $roles->save();
        Alert::success('Berhasil!!', 'Role berhasil diupdate');
        return redirect()->to('role');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Roles::find($id)->delete();
        Alert::success('Berhasil!', 'Role berhasil dihapus');
        return redirect()->to('role');
    }
}
