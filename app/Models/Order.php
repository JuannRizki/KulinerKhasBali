<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pesanans'; // Nama tabel di database

    protected $fillable = [
        'user_id',
        'order_id',
        'total_harga',
        'alamat',
        'status',
        'pembayaran',
        'snap_token',
        'status_pembayaran',
        'rating',
        'expired_at',
        'bukti_transfer',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke pesanan_items
    public function items()
    {
        return $this->hasMany(PesananItem::class, 'pesanan_id');
    }
}
