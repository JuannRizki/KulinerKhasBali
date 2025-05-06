<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // Ambil semua data pesanan
        return view('admin.orders', compact('orders')); // Kirim data ke view
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    // Metode untuk menampilkan form edit
    public function edit($id)
    {
        $order = Order::findOrFail($id); // Cari pesanan berdasarkan ID
        return view('admin.orders.edit', compact('order')); // Kirim data pesanan ke view
    }

    // Metode untuk menghapus pesanan
    public function destroy($id)
    {
        $order = Order::findOrFail($id); // Cari pesanan berdasarkan ID
        $order->delete(); // Hapus pesanan

        // Redirect kembali ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('admin.orders')->with('success', 'Pesanan berhasil dihapus!');
    }
}
