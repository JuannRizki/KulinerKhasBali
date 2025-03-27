<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = [
            [
                'nama' => 'Ayam Betutu',
                'asal' => 'Bali',
                'deskripsi' => 'Ayam berbumbu khas dengan rasa pedas dan gurih.',
                'gambar' => 'ayam_betutu.jpeg'
            ],
            [
                'nama' => 'Babi Guling',
                'asal' => 'Bali',
                'deskripsi' => 'Babi panggang dengan bumbu rempah khas Bali.',
                'gambar' => 'babi_guling.jpeg'
            ],
            [
                'nama' => 'Sate Lilit',
                'asal' => 'Bali',
                'deskripsi' => 'Sate unik yang dibalut di batang serai dengan rasa khas.',
                'gambar' => 'sate_lilit.jpeg'
            ],
            [
                'nama' => 'Lawar Bali',
                'asal' => 'Bali',
                'deskripsi' => 'Campuran sayur, daging, dan kelapa parut dengan bumbu khas.',
                'gambar' => 'lawar_bali.jpg'
            ],
        ];

        return view('menu.index', compact('menu'));
    }
}

