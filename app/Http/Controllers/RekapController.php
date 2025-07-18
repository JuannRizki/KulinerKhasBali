<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananItem;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        // 🔧 Ambil input tanggal dan filter
        $start = $request->input('start_date') ?: now()->startOfMonth()->toDateString();
        $end = $request->input('end_date') ?: now()->toDateString();
        $keyword = $request->input('keyword');
        $status = $request->input('status'); // tambahkan status filter opsional

        // ✅ Ambil semua pesanan dalam range tanggal (filter status kalau ada)
        $rekap = Pesanan::with(['user', 'items.menu'])
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            }, function ($q) {
                // default: hanya status yang valid (tanpa unpaid/cancelled)
                $q->whereIn('status', ['paid', 'being_delivered', 'delivered']);
            })
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at', 'desc')
            ->get();

        // ✅ Total pendapatan dari semua pesanan di atas
        $totalPendapatan = $rekap->sum('total_harga');

        // ✅ Filter berdasarkan nama menu (opsional)
        $menuYangDicari = null;
        $jumlahTerjual = 0;

        if ($keyword) {
            $jumlahTerjual = PesananItem::whereHas('menu', function ($q) use ($keyword) {
                    $q->where('nama', 'like', '%' . $keyword . '%');
                })
                ->whereHas('pesanan', function ($q) use ($start, $end, $status) {
                    $q->whereBetween('created_at', [$start, $end]);

                    // Filter status jika ada
                    if ($status) {
                        $q->where('status', $status);
                    } else {
                        $q->whereIn('status', ['paid', 'being_delivered', 'delivered']);
                    }
                })
                ->sum('jumlah');

            $menuYangDicari = $keyword;
        }

        // ✅ Data chart pendapatan harian
        $harian = Pesanan::select(DB::raw('DATE(created_at) as tanggal'), DB::raw('SUM(total_harga) as total'))
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            }, function ($q) {
                $q->whereIn('status', ['paid', 'being_delivered', 'delivered']);
            })
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labels = $harian->pluck('tanggal')->toArray();
        $totals = $harian->pluck('total')->toArray();

        return view('admin.rekap.index', compact(
            'rekap',
            'totalPendapatan',
            'start',
            'end',
            'status',
            'keyword',
            'menuYangDicari',
            'jumlahTerjual',
            'labels',
            'totals'
        ));
    }
}
