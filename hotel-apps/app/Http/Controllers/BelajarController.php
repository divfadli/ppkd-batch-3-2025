<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function getCallName(){
        return $this->callName();
    }
    public function tambah(){
        return view('tambah');
    }
}