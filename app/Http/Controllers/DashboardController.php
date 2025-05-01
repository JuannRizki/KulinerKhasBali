<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::with('pesanans')
            ->withAvg('pesanans', 'rating') // Ambil rata-rata rating
            ->when($request->search, function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->get();

        return view('user.dashboard', compact('menus'));
    }
}
