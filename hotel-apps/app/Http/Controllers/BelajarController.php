<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index() {
        $users = User::orderByDesc('id')->get();
        return view('belajar', compact('users'));
    }

    public function getCallName(Request $request) {
        $name = $request->query('say', 'Guest');
        return "Hello, " . $name;
    }

    public function operasi($tipe) {
        if (!in_array($tipe, ['tambah', 'kurang', 'kali', 'bagi'])) {
            abort(404);
        }

        return view('operasi', ['tipe' => $tipe]);
    }

    public function storeOperasi(Request $request, $tipe) {
        $angka1 = $request->input('angka1');
        $angka2 = $request->input('angka2');

        if (!is_numeric($angka1) || !is_numeric($angka2)) {
            return back()->withErrors('Input harus berupa angka')->withInput();
        }

        switch ($tipe) {
            case 'tambah':
                $hasil = $angka1 + $angka2;
                break;
            case 'kurang':
                $hasil = $angka1 - $angka2;
                break;
            case 'kali':
                $hasil = $angka1 * $angka2;
                break;
            case 'bagi':
                if ($angka2 == 0) {
                    return back()->withErrors('Tidak bisa membagi dengan nol')->withInput();
                }
                $hasil = $angka1 / $angka2;
                break;
            default:
                abort(404);
        }

        return view('operasi', [
            'tipe' => $tipe,
            'jumlah' => $hasil
        ]);
    }
}