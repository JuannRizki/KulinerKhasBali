<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;
use App\Models\Cart;
use App\Models\PesananItem;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'gambar',
        'stok',
    ];

    // Relasi ke tabel carts (untuk keranjang)
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relasi many-to-many ke pesanans via pesanan_items (pivot)
    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_items')
                    ->withPivot('jumlah', 'harga_satuan', 'rating') // tambahkan rating juga
                    ->withTimestamps();
    }

    // Relasi ke tabel pesanan_items (untuk withAvg rating)
    public function pesananItems()
    {
        return $this->hasMany(PesananItem::class);
    }
}
