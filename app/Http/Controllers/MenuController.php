<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // 📦 Admin - Daftar semua menu
    public function index()
    {
        $menus = Menu::orderByDesc('created_at')->get();
        return view('admin.menu.index', compact('menus'));
    }

    // 🆕 Admin - Form tambah menu
    public function create()
    {
        return view('admin.menu.create');
    }

    // 💾 Admin - Simpan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu = new Menu();
        $menu->nama = $request->nama;
        $menu->harga = $request->harga;
        $menu->stok = $request->stok;
        $menu->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $menu->gambar = $filename;
        }

        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    // ✏️ Admin - Form edit menu
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    // ✅ Admin - Update menu
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu->nama = $request->nama;
        $menu->harga = $request->harga;
        $menu->stok = $request->stok;
        $menu->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            if ($menu->gambar && file_exists(public_path('images/' . $menu->gambar))) {
                unlink(public_path('images/' . $menu->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $menu->gambar = $filename;
        }

        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    // ❌ Admin - Hapus menu
    public function destroy(Menu $menu)
    {
        if ($menu->gambar && file_exists(public_path('images/' . $menu->gambar))) {
            unlink(public_path('images/' . $menu->gambar));
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus.');
    }

    // ⭐ Tampilkan 10 menu terbaik berdasarkan rating
    public function terbaik()
    {
        $menus = Menu::withAvg('pesananItems as pesanan_items_avg_rating', 'rating')
            ->where('stok', '>', 0)
            ->orderByDesc('pesanan_items_avg_rating')
            ->take(10)
            ->get();

        return view('user.menu.index', [
            'menus' => $menus,
            'user' => auth()->user(),
        ]);
    }

    // 🍽️ User - Daftar menu (search di nama saja)
    public function userIndex(Request $request)
    {
        $search = $request->query('search');

        $menus = Menu::withAvg('pesananItems as pesanan_items_avg_rating', 'rating')
            ->where('stok', '>', 0)
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orderByDesc('pesanan_items_avg_rating')
            ->paginate(10)
            ->withQueryString();

        return view('user.menu.index', [
            'menus' => $menus,
            'user' => auth()->user(),
        ]);
    }
}
