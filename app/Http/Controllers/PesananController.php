<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Midtrans\Snap;
use Midtrans\Config;

class PesananController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $pesanans = Pesanan::where('user_id', auth()->id())
            ->whereNotIn('status', ['paid', 'canceled', 'being_delivered'])
            ->with('pesananItems.menu')
            ->latest()
            ->get();

        return view('user.pesanan.index', compact('pesanans'));
    }

    public function history()
    {
        $pesanans = Pesanan::where('user_id', auth()->id())
            ->whereIn('status', ['paid', 'being_delivered'])
            ->with('pesananItems.menu')
            ->latest()
            ->get();

        return view('user.pesanan.history', compact('pesanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
        ]);

        $cart = Cart::with('menu')->where('user_id', auth()->id())->get();
        if ($cart->isEmpty()) {
            return back()->with('error', 'Keranjang kamu kosong.');
        }

        DB::beginTransaction();

        try {
            $total = $cart->sum(fn($item) => $item->menu->harga * $item->jumlah);

            $pesanan = Pesanan::create([
                'user_id' => auth()->id(),
                'alamat' => $request->alamat,
                'total_harga' => $total,
                'status' => 'unpaid',
                'status_pembayaran' => 'pending',
                'expired_at' => now()->addMinutes(15),
            ]);

            $orderId = 'ORDER-' . $pesanan->id;
            $pesanan->update(['order_id' => $orderId]);

            foreach ($cart as $item) {
                $menu = Menu::find($item->menu_id);
                if ($menu->stok < $item->jumlah) {
                    DB::rollBack();
                    return back()->with('error', "Stok untuk {$menu->nama} tidak mencukupi.");
                }
                $menu->stok -= $item->jumlah;
                $menu->save();

                PesananItem::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $item->menu_id,
                    'jumlah' => $item->jumlah,
                    'harga_satuan' => $item->menu->harga,
                ]);
            }

            $snapToken = Snap::getSnapToken([
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
                'callbacks' => [
                    'finish' => route('pesanan.index'),
                ],
            ]);

            $pesanan->update([
                'snap_token' => $snapToken,
                'pembayaran' => 'midtrans',
            ]);

            Cart::where('user_id', auth()->id())->delete();
            DB::commit();

            return redirect()->route('pesanan.bayar', $pesanan->id);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    public function bayar($id)
    {
        $pesanan = Pesanan::where('user_id', auth()->id())->findOrFail($id);
        return view('user.pesanan.pembayaran', compact('pesanan'));
    }

    public function callback(Request $request)
    {
        Log::info('Midtrans Callback:', $request->all());

        $serverKey = env('MIDTRANS_SERVER_KEY');
        $signatureKey = hash('sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signatureKey !== $request->signature_key) {
            Log::error('Signature key tidak valid.');
            return response()->json(['message' => 'Signature tidak valid'], 403);
        }

        $parts = explode('-', $request->order_id);
        $id = $parts[1] ?? null;
        $pesanan = Pesanan::find($id);

        if (!$pesanan) {
            Log::error("Pesanan dengan ID $id tidak ditemukan.");
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }

        $status = $request->transaction_status;

        if (in_array($status, ['capture', 'settlement'])) {
            $pesanan->update([
                'status' => 'paid',
                'status_pembayaran' => 'dibayar',
            ]);
        } elseif ($status === 'expire') {
            $pesanan->update(['status' => 'expired']);
        } elseif ($status === 'cancel') {
            $pesanan->update(['status' => 'canceled']);
        }

        return response()->json(['message' => 'Callback diproses']);
    }

    public function batal($id)
    {
        $pesanan = Pesanan::where('user_id', auth()->id())->findOrFail($id);
        if (!in_array($pesanan->status, ['paid', 'being_delivered'])) {
            foreach ($pesanan->pesananItems as $item) {
                $menu = $item->menu;
                if ($menu) {
                    $menu->stok += $item->jumlah;
                    $menu->save();
                }
            }
            $pesanan->pesananItems()->delete();
            $pesanan->delete();
            return redirect()->route('pesanan.index')->with('success', 'Pesanan dibatalkan.');
        }
        return redirect()->route('pesanan.index')->with('error', 'Pesanan sudah dibayar atau sedang dikirim, tidak bisa dibatalkan.');
    }

    public function cetakStruk($id)
    {
        $pesanan = Pesanan::with('pesananItems.menu', 'user')->findOrFail($id);
        if (auth()->id() !== $pesanan->user_id && !auth()->user()->is_admin) {
            abort(403);
        }
        $pdf = Pdf::loadView('user.pesanan.struk_pdf', ['pesanan' => $pesanan]);
        return $pdf->download('struk-' . $pesanan->order_id . '.pdf');
    }

    public function detailStruk($id)
    {
        $pesanan = Pesanan::with('pesananItems.menu', 'user')->findOrFail($id);
        if (auth()->id() !== $pesanan->user_id && !auth()->user()->is_admin) {
            abort(403);
        }
        return view('user.pesanan.struk', compact('pesanan'));
    }

    public function updateRating(Request $request, $id)
    {
        $request->validate([
            'ratings' => 'required|array',
            'ratings.*' => 'nullable|integer|min:1|max:5',
        ]);

        $pesanan = Pesanan::where('user_id', auth()->id())->findOrFail($id);

        if (!in_array($pesanan->status, ['paid', 'being_delivered'])) {
            return back()->with('error', 'Hanya pesanan yang sudah dibayar atau sedang dikirim yang bisa diberi rating.');
        }

        foreach ($request->ratings as $itemId => $rating) {
            $item = PesananItem::where('id', $itemId)
                ->where('pesanan_id', $pesanan->id)
                ->first();

            if ($item && $rating) {
                $item->rating = $rating;
                $item->save();
            }
        }

        return back()->with('success', 'Rating berhasil dikirim.');
    }

    public function markPaid($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = 'paid';
        $pesanan->status_pembayaran = 'dibayar';
        $pesanan->save();
        $pesanan->refresh();
        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil ditandai sebagai sudah dibayar.',
            'status' => $pesanan->status,
            'status_pembayaran' => $pesanan->status_pembayaran
        ]);
    }
}
