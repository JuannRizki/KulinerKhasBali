<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    // Menampilkan daftar menu (admin)
    public function index()
    {
        $menus = Menu::all();
        return view('admin.menu.index', compact('menus'));
    }

    // Menampilkan form untuk menambahkan menu baru (admin)
    public function create()
    {
        return view('admin.menu.create');
    }

    // Menyimpan menu baru (admin)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu = new Menu();
        $menu->nama = $request->nama;
        $menu->harga = $request->harga;
        $menu->deskripsi = $request->deskripsi;

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $menu->gambar = $filename;
        }

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    // Menampilkan form edit menu (admin)
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit', compact('menu'));
    }

    // Memperbarui menu (admin)
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu->nama = $request->nama;
        $menu->harga = $request->harga;
        $menu->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($menu->gambar && file_exists(public_path('images/' . $menu->gambar))) {
                unlink(public_path('images/' . $menu->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $menu->gambar = $filename;
        }

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    // Menghapus menu (admin)
    public function destroy(Menu $menu)
    {
        if ($menu->gambar && file_exists(public_path('images/' . $menu->gambar))) {
            unlink(public_path('images/' . $menu->gambar));
        }

        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }

    // Menampilkan menu terbaik untuk user dengan rata-rata rating dari pesanan melalui relasi many-to-many
    public function terbaik()
    {
        $menus = Menu::leftJoin('pesanan_items', 'menus.id', '=', 'pesanan_items.menu_id')
            ->leftJoin('pesanans', 'pesanan_items.pesanan_id', '=', 'pesanans.id')
            ->select('menus.id', 'menus.nama', 'menus.deskripsi', 'menus.harga', 'menus.gambar', DB::raw('AVG(pesanans.rating) as avg_rating'))
            ->groupBy('menus.id', 'menus.nama', 'menus.deskripsi', 'menus.harga', 'menus.gambar')
            ->orderByDesc('avg_rating')
            ->take(10)
            ->get();

        $user = auth()->user();

        return view('user.menu.index', compact('menus', 'user'));
    }

    // Menampilkan daftar menu untuk user dengan fitur pencarian dan pagination
    public function userIndex(Request $request)
    {
        $search = $request->query('search');

        $menus = Menu::query();

        if ($search) {
            $menus->where('nama', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $menus = $menus->paginate(10)->withQueryString();

        $user = auth()->user();

        return view('user.menu.index', compact('menus', 'user'));
    }
}
