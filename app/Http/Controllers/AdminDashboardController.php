<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Mengambil data yang diperlukan untuk dashboard
        $totalMenus = DB::table('menus')->count();
        $totalPesanans = DB::table('pesanans')->count();
        $totalUsers = DB::table('users')->count();

        // Menampilkan halaman dashboard dengan data
        return view('admin.dashboard', compact('totalMenus', 'totalPesanans', 'totalUsers'));
    }
}
