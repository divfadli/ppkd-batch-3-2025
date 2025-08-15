<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function callName(){
        return "Selamat datang, Guest!";
    }
}