<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start_date') ?? now()->startOfMonth()->format('Y-m-d');
        $end = $request->input('end_date') ?? now()->format('Y-m-d');
        $keyword = $request->input('keyword');

        // ✅ Filter status LUNAS & DIKIRIM
        $query = Pesanan::whereIn('status', ['paid', 'being_delivered', 'delivered']);

        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }

        $rekap = $query->with(['user', 'items.menu'])
                       ->orderBy('created_at', 'desc')
                       ->get();

        $totalPendapatan = $rekap->sum('total_harga');

        // 🔍 Hitung total penjualan menu yang dicari
        $menuYangDicari = null;
        $jumlahTerjual = 0;

        if ($keyword) {
            $itemQuery = PesananItem::whereHas('menu', function ($q) use ($keyword) {
                    $q->where('nama', 'like', '%' . $keyword . '%');
                })
                ->whereHas('pesanan', function ($q) use ($start, $end) {
                    $q->whereIn('status', ['paid', 'being_delivered', 'delivered']);
                    if ($start && $end) {
                        $q->whereBetween('created_at', [$start, $end]);
                    }
                });

            $total = $itemQuery->sum('jumlah');

            $menuYangDicari = $keyword;
            $jumlahTerjual = $total;
        }

        // ✅ Chart harian hitung semua status valid
        $harian = Pesanan::whereIn('status', ['paid', 'being_delivered', 'delivered'])
            ->when($start && $end, function ($q) use ($start, $end) {
                $q->whereBetween('created_at', [$start, $end]);
            })
            ->select(DB::raw('DATE(created_at) as tanggal'), DB::raw('SUM(total_harga) as total'))
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
            'keyword',
            'menuYangDicari',
            'jumlahTerjual',
            'labels',
            'totals'
        ));
    }
}

