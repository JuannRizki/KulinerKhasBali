<?php
namespace App\Http\Controllers;

use App\Models\PesananItem;
use Illuminate\Http\Request;

class AdminRatingController extends Controller
{
    public function index(Request $request)
    {
        $menuId = $request->menu_id;

        // Ringkasan rating per menu
        $ratings = PesananItem::with('menu')
            ->whereNotNull('rating')
            ->selectRaw('menu_id, COUNT(*) as total_rating, AVG(rating) as average_rating')
            ->groupBy('menu_id')
            ->get();

        $emailsWithRatings = collect(); // kosong default

        if ($menuId) {
            // Ambil hanya data rating berdasarkan menu_id
            $emailsWithRatings = PesananItem::with(['menu', 'pesanan.user'])
                ->whereNotNull('rating')
                ->where('menu_id', $menuId)
                ->get();
        }

        return view('admin.ratings.index', compact('ratings', 'emailsWithRatings', 'menuId'));
    }
}
