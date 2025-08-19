<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function callName($name){
        return "Selamat datang, " . ucfirst($name) . "!";
    }
}