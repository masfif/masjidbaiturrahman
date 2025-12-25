<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KalkulatorController extends Controller
{
    public function index()
    {
        // ganti nilai default berikut sesuai kebutuhan atau ambil dari API/db
        $data = [
            'harga_beras' => 10000,
            'harga_emas_per_gram' => 1200000,
        ];

        return view('kalkulator.index', $data);
    }
}
