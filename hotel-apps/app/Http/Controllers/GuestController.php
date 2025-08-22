<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Guest::orderByDesc('id')->get();
        $title = 'Guest Information';
        return view('layout.guest_information.index', compact('datas','title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::get();
        $title = 'Tambah Information Guest';
        return view('layout.guest_information.form', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $rule = [
            'name_guest'     => ['required'],
            'check_in'       => ['required', 'date'],
            'check_out'      => ['required', 'date', 'after:check_in'],
            'number_room'    => ['required', Rule::in(['A01', 'A02', 'A03', 'A04'])],
            'email'          => ['required', 'email', 'unique:guests'],
            'phone'          => ['required', 'string', 'unique:guests'],
            'status_guest'   => ['required'],
            'address'        => ['required'],
            'special_needs'  => ['nullable', 'string'],
        ];

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Guest::create($request->all());

        return redirect()
            ->route('guest-information.index')
            ->with('success', 'Data tamu berhasil ditambahkan');
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
        $guest = Guest::find($id);
        $categories = Categories::get();
        $title = "Change Information Guest";
        return view('layout.guest_information.form', compact('guest', 'title','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rule = [
            'name_guest'     => ['required'],
            'check_in'       => ['required', 'date'],
            'check_out'      => ['required', 'date', 'after:check_in'],
            'number_room'    => ['required', Rule::in(['A01', 'A02', 'A03', 'A04'])],
            'status_guest'   => ['required'],
            'address'        => ['required'],
            'special_needs'  => ['nullable', 'string'],
        ];

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

     // Ambil hanya field yang valid
    $data = $request->only([
        'name_guest', 'check_in', 'check_out', 'number_room',
        'status_guest', 'address', 'special_needs',
        'email', 'phone', 'category_id'
    ]);

    // Update record
    Guest::where('id', $id)->update($data);

        return redirect()
            ->route('guest-information.index')
            ->with('success', 'Data tamu berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Guest::find($id)->delete();
        return redirect()->to('guest-information')->with('success', 'Data Tamu Berhasil dihapus');
    }
}