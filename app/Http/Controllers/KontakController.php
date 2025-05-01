<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        // Mengambil semua pesan yang sudah ada di database, disusun berdasarkan yang terbaru
        $kontaks = Kontak::latest()->get(); // Menampilkan pesan terbaru terlebih dahulu
        return view('user.kontak', compact('kontaks'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form kontak
        $request->validate([
            'nama' => 'required|string|max:255',  // Nama tidak boleh kosong, dan maksimal 255 karakter
            'email' => 'required|email|max:255', // Email harus valid dan maksimal 255 karakter
            'pesan' => 'required|string',        // Pesan tidak boleh kosong
        ]);

        // Simpan data kontak ke database
        Kontak::create([
            'nama' => $request->nama,            // Nama pengirim pesan
            'email' => $request->email,          // Email pengirim pesan
            'pesan' => $request->pesan,          // Isi pesan
        ]);

        // Redirect ke halaman kontak dengan pesan sukses
        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
