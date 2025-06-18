<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan daftar pesanan untuk admin
    public function index()
    {
        $orders = Pesanan::with(['pesananItems.menu', 'user'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    // Tandai pesanan sebagai sudah dibayar (manual)
    public function markAsPaid($id)
    {
        $order = Pesanan::findOrFail($id);

        if ($order->status === 'unpaid') {
            $order->status = 'paid';
            $order->save();

            return redirect()->route('admin.orders')->with('success', 'Order marked as paid successfully.');
        }

        return redirect()->route('admin.orders')->with('error', 'Order is not valid to mark as paid.');
    }

    // Tandai pesanan sebagai sedang dikirim
    public function markAsDelivered($id)
    {
        $order = Pesanan::findOrFail($id);

        if ($order->status === 'paid') {
            $order->status = 'being_delivered';
            $order->save();

            return redirect()->route('admin.orders')->with('success', 'Order marked as being delivered.');
        }

        return redirect()->route('admin.orders')->with('error', 'Order cannot be marked as delivered.');
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $order = Pesanan::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully!');
    }

    // Approve pesanan (ubah status waiting_verification jadi paid)
    public function approve($id)
    {
        $order = Pesanan::findOrFail($id);

        if ($order->status === 'waiting_verification') {
            $order->status = 'paid';
            $order->status_pembayaran = 'paid'; // sesuaikan nama kolom jika perlu
            $order->save();

            return redirect()->route('admin.orders')->with('success', 'Order approved and marked as paid.');
        }

        return redirect()->route('admin.orders')->with('error', 'Order is not valid for approval.');
    }
}
