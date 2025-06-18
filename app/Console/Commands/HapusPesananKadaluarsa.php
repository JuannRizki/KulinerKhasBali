<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pesanan;
use Carbon\Carbon;

class HapusPesananKadaluarsa extends Command
{
    protected $signature = 'pesanan:hapus-kadaluarsa';
    protected $description = 'Menghapus pesanan yang belum dibayar dan telah kadaluarsa (15 menit)';

    public function handle()
    {
        $jumlah = Pesanan::where('status', '!=', 'paid')
            ->where('expired_at', '<', Carbon::now())
            ->delete();

        $this->info("Pesanan kadaluarsa yang dihapus: $jumlah");
    }
}
