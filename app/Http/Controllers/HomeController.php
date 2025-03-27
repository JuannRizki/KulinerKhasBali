<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data berdasarkan pencarian (jika ada)
        $search = $request->input('search');
        $menus = Menu::where('nama', 'like', "%$search%")->get();

        return view('home', compact('menus'));
    }
}

