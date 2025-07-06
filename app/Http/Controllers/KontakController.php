<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    // 📥 Form & kirim pesan user
    public function index()
    {
        $kontaks = Kontak::latest()->get();
        return view('user.kontak', compact('kontaks'));
    }

    // 💾 Simpan pesan user
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

    // 📬 Admin: Lihat semua pesan
    public function lihatPesan()
    {
        $kontaks = Kontak::latest()->get();
        return view('admin.contacts.index', compact('kontaks'));
    }

    // ❌ Admin: Hapus pesan
    public function hapusPesan($id)
    {
        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->route('admin.contacts')->with('success', 'Pesan berhasil dihapus.');
    }

    // ✅ Admin: Balas pesan
    public function balasPesan(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required|string',
        ]);

        $kontak = Kontak::findOrFail($id);
        $kontak->balasan = $request->balasan;
        $kontak->save();

        return redirect()->route('admin.contacts')->with('success', 'Pesan berhasil dibalas.');
    }
}
