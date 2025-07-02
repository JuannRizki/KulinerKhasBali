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

        $rekap = $query->with('user')->orderBy('created_at', 'desc')->get();

        // Total penjualan
        $totalPendapatan = $rekap->sum('total_harga');

        return view('admin.rekap.index', compact('rekap', 'totalPendapatan', 'start', 'end'));
    }
}
