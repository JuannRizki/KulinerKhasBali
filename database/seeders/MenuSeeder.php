<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->insert([
            ['nama' => 'Ayam Betutu', 'deskripsi' => 'Ayam dengan bumbu khas Bali', 'harga' => 12000, 'gambar' => 'ayam_betutu.jpg'],
            ['nama' => 'Bebek Betutu', 'deskripsi' => 'Bebek dengan bumbu khas Bali', 'harga' => 13000, 'gambar' => 'bebek_betutu.jpg'],
            ['nama' => 'Sate Lilit', 'deskripsi' => 'Makanan dibuat dari daging ayam cincang', 'harga' => 20000, 'gambar' => 'sate_lilit.jpg'],
        ]);
    }
}
