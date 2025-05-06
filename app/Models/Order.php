<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'pesanans'; // Ini yang penting

    protected $fillable = [
        'menu_id', 'user_id', 'total_harga', 'alamat',
        'status', 'pembayaran', 'status_pembayaran', 'rating'
    ];
}
