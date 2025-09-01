<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BangunRuangController extends Controller
{
    public function index()
    {
        return view('layout.bangun-ruang.index');
    }

    public function indexKubus()
    {
        return view('layout.bangun-ruang.kubus');
    }

    public function indexBalok()
    {
        return view('layout.bangun-ruang.balok');
    }

    public function indexLimasSegiEmpat()
    {
        return view('layout.bangun-ruang.limas-segi-empat');
    }

    public function indexTabung()
    {
        return view('layout.bangun-ruang.tabung');
    }

    public function indexBola()
    {
        return view('layout.bangun-ruang.bola');
    }

    public function operasiKubus(Request $req)
    {
        $req->validate([
            'sisi' => 'required|numeric|min:1'
        ]);

        $sisi = $req->sisi;

        $hasil = [
            'sisi' => $sisi,
            'luas' => 6 * ($sisi ** 2),
            'volume' => $sisi ** 3
        ];

        return view('layout.bangun-ruang.kubus', compact('hasil'));
    }
    public function operasiBalok(Request $req)
    {
        $req->validate([
            'panjang' => 'required|numeric|min:1',
            'lebar' => 'required|numeric|min:1',
            'tinggi' => 'required|numeric|min:1',
        ]);

        $panjang = $req->panjang;
        $lebar = $req->lebar;
        $tinggi = $req->tinggi;

        $hasil = [
            'panjang' => $panjang,
            'lebar' => $lebar,
            'tinggi' => $tinggi,
            'luas' =>  2 * (($panjang * $lebar) + ($panjang * $tinggi) + ($lebar * $tinggi)),
            'volume' => $panjang * $lebar  * $tinggi
        ];

        return view('layout.bangun-ruang.balok', compact('hasil'));
    }
    public function operasiLimasSegiEmpat(Request $req)
    {
        $req->validate([
            'sisi' => 'required|numeric|min:1',
            'tinggi' => 'required|numeric|min:1',
        ]);

        $sisi = $req->sisi;
        $tinggi = $req->tinggi;

        $luasAlas = $sisi ** 2;

        $hasil = [
            'sisi' => $sisi,
            'tinggi' => $tinggi,
            'luas' =>  $luasAlas,
            'volume' => ($luasAlas * $tinggi)/3
        ];

        return view('layout.bangun-ruang.limas-segi-empat', compact('hasil'));
    }
    public function operasiTabung(Request $req)
    {
        $req->validate([
            'jari2' => 'required|numeric|min:1',
            'tinggi' => 'required|numeric|min:1',
        ]);

        $jari2 = $req->jari2;
        $tinggi = $req->tinggi;

        $hasil = [
            'jari2' => $jari2,
            'tinggi' => $tinggi,
            'luas' =>  2 * pi() * $jari2 * ($jari2 + $tinggi),
            'volume' => pi() * $jari2 ** 2 * $tinggi
        ];

        return view('layout.bangun-ruang.tabung', compact('hasil'));
    }
    public function operasiBola(Request $req)
    {
        $req->validate([
            'jari2' => 'required|numeric|min:1',
        ]);

        $jari2 = $req->jari2;

        $hasil = [
            'jari2' => $jari2,
            'luas' => 4 * pi() * $jari2 ** 3,
            'volume' => (4 * pi() * $jari2 ** 3)/3
        ];

        return view('layout.bangun-ruang.bola', compact('hasil'));
    }
}