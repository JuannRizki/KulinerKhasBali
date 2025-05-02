<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan
    public function index()
    {
        $pesanans = Pesanan::where('user_id', auth()->id())->get(); // Mengambil semua pesanan berdasarkan user_id
        return view('user.pesanan.index', compact('pesanans')); // Mengarahkan ke view yang berada di folder user/pesanan
    }

    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'total_harga' => 'required|numeric',
        ]);

        Pesanan::create([
            'menu_id' => $request->menu_id,
            'total_harga' => $request->total_harga,
            'user_id' => auth()->id(), // Menggunakan auth()->id() untuk mengambil user yang sedang login
            'status' => 'pending', // Status default "pending"
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    // Menambahkan rating ke pesanan
    public function updateRating(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5', // Rating antara 1 sampai 5
        ]);

        $pesanan = Pesanan::findOrFail($id); // Menemukan pesanan berdasarkan ID

        // Cek apakah pesanan sudah dibayar
        if ($pesanan->status !== 'paid') {
            return redirect()->route('pesanan.index')->with('error', 'Anda harus membayar terlebih dahulu sebelum memberikan rating.');
        }

        // Jika sudah dibayar, simpan rating
        $pesanan->rating = $request->rating;  // Mengupdate rating
        $pesanan->save(); // Menyimpan perubahan

        return redirect()->route('pesanan.index')->with('success', 'Rating berhasil ditambahkan!');
    }

    // Menyimpan metode pembayaran ke pesanan
    public function updatePembayaran(Request $request, $id)
    {
        $request->validate([
            'pembayaran' => 'required|in:COD,Transfer Bank,QRIS', // Validasi metode pembayaran
        ]);

        $pesanan = Pesanan::findOrFail($id); // Menemukan pesanan berdasarkan ID

        // Mengecek apakah status pesanan sudah dibayar atau belum
        if ($pesanan->status === 'paid') {
            return redirect()->route('pesanan.index')->with('error', 'Pesanan sudah dibayar!');
        }

        $pesanan->pembayaran = $request->pembayaran; // Menyimpan pilihan metode pembayaran
        $pesanan->status = 'paid'; // Mengupdate status menjadi 'paid'
        $pesanan->save(); // Menyimpan perubahan

        return redirect()->route('pesanan.index')->with('success', 'Metode pembayaran berhasil disimpan!');
    }

    // Membatalkan pesanan
    public function batal($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Pastikan hanya pemilik pesanan yang bisa membatalkan
        if ($pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        $pesanan->delete(); // Menghapus pesanan dari database

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // Menampilkan pesanan yang sudah dibayar
    public function pembayaran()
    {
        $pesanans = Pesanan::where('user_id', auth()->id())
                           ->where('status', 'paid') // Mengambil pesanan yang sudah dibayar
                           ->get();

        return view('user.pembayaran.index', compact('pesanans')); // Mengarahkan ke view di folder user/pembayaran
    }

    // Menampilkan detail struk pembayaran
    public function detailStruk($id)
    {
        $pesanan = Pesanan::findOrFail($id); // Mencari pesanan berdasarkan ID

        // Pastikan pesanan yang ditampilkan adalah yang sudah dibayar
        if ($pesanan->status !== 'paid') {
            return redirect()->route('pembayaran.index')->with('error', 'Pesanan belum dibayar.');
        }

        return view('user.pembayaran.detail', compact('pesanan')); // Mengarahkan ke detail pembayaran di folder user/pembayaran
    }
}
