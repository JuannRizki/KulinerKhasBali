<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    // 📥 Menampilkan form & pesan yang dikirim user
    public function index()
    {
        $kontaks = Kontak::latest()->get(); // Menampilkan pesan terbaru dulu
        return view('user.kontak', compact('kontaks'));
    }

    // 💾 Menyimpan pesan dari user
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);

        Kontak::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim!');
    }

    // 📬 Admin: Melihat semua pesan dari user
    public function lihatPesan()
    {
        $kontaks = Kontak::latest()->get();
        return view('admin.contacts.index', compact('kontaks'));
    }

    // ❌ Admin: Menghapus pesan tertentu
    public function hapusPesan($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('admin.contacts')->with('success', 'Pesan berhasil dihapus.');

    }
}
