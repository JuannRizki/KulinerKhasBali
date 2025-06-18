<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pesanan;
use App\Models\Cart;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'gambar',
    ];

    // Relasi many-to-many ke tabel 'pesanans' lewat 'pesanan_items' pivot table
    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_items')
                    ->withPivot('jumlah', 'harga_satuan')
                    ->withTimestamps();
    }

    // Relasi ke tabel 'carts'
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
