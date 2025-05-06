<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan pengguna
    public function index()
    {
        $pesanans = Pesanan::where('user_id', auth()->id())->get();
        return view('user.pesanan.index', compact('pesanans'));
    }

    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'total_harga' => 'required|numeric',
            'alamat' => 'required|string|max:255',
        ]);

        Pesanan::create([
            'menu_id'     => $request->menu_id,
            'total_harga' => $request->total_harga,
            'alamat'      => $request->alamat,
            'user_id'     => auth()->id(),
            'status'      => 'pending', // Status pesanan baru
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    // Memberikan rating pada pesanan
    public function updateRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status !== 'paid') {
            return redirect()->route('pesanan.index')->with('error', 'Bayar dulu sebelum beri rating.');
        }

        $pesanan->rating = $request->rating;
        $pesanan->save();

        return redirect()->route('pesanan.index')->with('success', 'Rating berhasil ditambahkan!');
    }

    // Memilih metode pembayaran dan mengubah status ke paid
    public function updatePembayaran(Request $request, $id)
    {
        $request->validate([
            'pembayaran' => 'required|in:COD,Transfer Bank,QRIS',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status === 'paid') {
            return redirect()->route('pesanan.index')->with('error', 'Pesanan sudah dibayar!');
        }

        $pesanan->pembayaran = $request->pembayaran;
        $pesanan->status = 'paid';
        $pesanan->save();

        return redirect()->route('pesanan.index')->with('success', 'Pembayaran berhasil!');
    }

    // Membatalkan pesanan
    public function batal($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        $pesanan->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // Menampilkan pesanan yang sudah dibayar
    public function pembayaran()
    {
        $pesanans = Pesanan::where('user_id', auth()->id())
                           ->where('status', 'paid')
                           ->get();

        return view('user.pembayaran.index', compact('pesanans'));
    }

    // Menampilkan detail struk dari pesanan yang sudah dibayar
    public function detailStruk($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status !== 'paid') {
            return redirect()->route('pembayaran.index')->with('error', 'Pesanan belum dibayar.');
        }

        return view('user.pembayaran.detail', compact('pesanan'));
    }
}
