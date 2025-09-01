<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function actionLogin(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // Jika user ditemukan / berhasil login
        if(Auth::attempt($req->only('email','password'))){
            $req->session()->regenerate();
            return redirect()->intended('/dashboard')->with('succes','Login Berhasil');
        }

        return back()->withErrors(['email'=> 'Email atau password salah'])->onlyInput('email');
    }

    public function logout(Request $req){
        Auth::guard('web')->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('login');
    }
}