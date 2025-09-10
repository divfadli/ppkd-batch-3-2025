<?php

namespace App\Traits;

use RealRashid\SweetAlert\Facades\Alert;

trait withSuccessErrorDeleteMessage
{
    public function __construct()
    {
        if (session('success_message')) {
            Alert::success('Berhasil!!', session('success_message'));
        }

        if (session('error_message')) {
            Alert::error('Error!!', session('error_message'));
        }
    }

    public function confirmDeleteGlobal($title, $text)
    {
        confirmDelete($title, $text);
    }
}
