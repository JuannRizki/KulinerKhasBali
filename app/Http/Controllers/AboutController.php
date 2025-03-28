<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Menampilkan halaman About.
     */
    public function index()
    {
        $about = "Website ini didedikasikan untuk memperkenalkan keunikan dan kekayaan budaya kuliner khas Bali. Selain memberikan informasi tentang kuliner Bali, kami juga menyediakan layanan jual beli berbagai makanan khas Bali dengan kualitas terbaik dan harga terjangkau.";
        
        return view('about', compact('about'));
    }
}
