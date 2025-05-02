<?php


namespace App\Http\Controllers;

use App\Models\Menu; // Pastikan kamu sudah punya model Menu
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data menu dari database
        $menus = Menu::all(); // Atau dengan filter pencarian jika perlu
        return view('home', compact('menus')); // Mengirim data ke view home
    }

    public function dashboard()
    {
        // Ambil data menu untuk dashboard
        $menus = Menu::all(); // Ambil semua data menu
        return view('dashboard', compact('menus')); // Kirim data menu ke view dashboard
    }
}


