<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Menampilkan halaman lokasi.
     */
    public function index()
    {
        return view('location');
    }
}
