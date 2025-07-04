<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        // Filter berdasarkan tanggal dari form filter
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = Pesanan::where('status', 'paid');

        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }

        $rekap = $query->with(['user', 'items.menu'])->orderBy('created_at', 'desc')->get();

        // Total penjualan
        $totalPendapatan = $rekap->sum('total_harga');

        // Cari makanan paling laris
        $makananTerlaris = null;
        $jumlahTerjual = 0;
        $itemQuery = \App\Models\PesananItem::query();
        $itemQuery->whereHas('pesanan', function($q) use ($start, $end) {
            $q->where('status', 'paid');
            if ($start && $end) {
                $q->whereBetween('created_at', [$start, $end]);
            }
        });
        $terlaris = $itemQuery->select('menu_id')
            ->selectRaw('SUM(jumlah) as total_terjual') // ganti qty menjadi jumlah
            ->groupBy('menu_id')
            ->orderByDesc('total_terjual')
            ->first();
        if ($terlaris) {
            $menu = \App\Models\Menu::find($terlaris->menu_id);
            $makananTerlaris = $menu ? $menu->nama : null;
            $jumlahTerjual = $terlaris->total_terjual;
        }

        return view('admin.rekap.index', compact('rekap', 'totalPendapatan', 'start', 'end', 'makananTerlaris', 'jumlahTerjual'));
    }
}
