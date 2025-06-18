<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PesananItem;
use App\Models\User;
use App\Models\Menu;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_harga',
        'alamat',
        'user_id',
        'status',
        'rating',
        'expired_at',
        'snap_token',
        'pembayaran',
        'status_pembayaran',
        'bukti_transfer',
        'order_id',
    ];

    protected $dates = ['expired_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesananItems()
    {
        return $this->hasMany(PesananItem::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'pesanan_items')
                    ->withPivot('jumlah', 'harga_satuan')
                    ->withTimestamps();
    }
}
