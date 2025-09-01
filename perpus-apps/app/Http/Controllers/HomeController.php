<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $title = 'Dashboard | Perpustakaan';
        $subtitle = 'Halaman Dashboard';

        return view('dashboard.index', compact('title', 'subtitle'));
    }
}