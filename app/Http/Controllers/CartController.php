<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan isi keranjang
    public function index()
    {
        $user = Auth::user();
        $items = Cart::with('menu')->where('user_id', $user->id)->get();
        return view('cart.index', compact('items'));
    }

    // Tambahkan item ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())
                    ->where('menu_id', $request->menu_id)
                    ->first();

        if ($cart) {
            $cart->jumlah += $request->jumlah;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $request->menu_id,
                'jumlah' => $request->jumlah
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item ditambahkan ke keranjang.');
    }

    // Update jumlah item
    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $cart->update(['jumlah' => $request->jumlah]);

        return back()->with('success', 'Jumlah diperbarui.');
    }

    // Hapus item dari keranjang
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}
