<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'id' => 1,
                'nama' => 'Ayam Betutu',
                'deskripsi' => 'Ayam utuh atau potongan yang dimasak perlahan dengan bumbu betutu khas Bali. Gurih pedasnya meresap sampai ke tulang! Disajikan dengan sambal matah segar dan nasi putih hangat.',
                'harga' => 45000,
                'gambar' => '1751555522_ayambetutu.jpeg',
                'created_at' => '2025-04-13 04:24:06',
                'updated_at' => '2025-07-04 01:53:53',
                'stok' => 4,
            ],
            [
                'id' => 2,
                'nama' => 'Babi Guling',
                'deskripsi' => 'Babi Guling adalah salah satu sajian paling legendaris dari Bali. Dimasak utuh dengan bumbu genep Bali yang meresap ke setiap lapisan dagingnya. Kulitnya renyah, dagingnya gurih dan juicy, disajikan dengan lawar, sambal matah, dan nasi hangat.',
                'harga' => 60000,
                'gambar' => '1751555624_babiguling.jpg',
                'created_at' => '2025-04-13 04:24:06',
                'updated_at' => '2025-07-03 08:13:44',
                'stok' => 2,
            ],
            [
                'id' => 3,
                'nama' => 'Bebek Betutu',
                'deskripsi' => 'Bebek Betutu adalah bebek utuh atau potong yang dimasak perlahan dengan bumbu rempah genep khas Bali. Dagingnya empuk, bumbunya meresap sampai ke tulang, rasanya gurih pedas yang bikin kangen Bali! Biasanya disajikan dengan nasi hangat, lawar, urap, dan sambal matah segar.',
                'harga' => 50000,
                'gambar' => '1751555406_bebekbetutu.jpg',
                'created_at' => '2025-04-13 04:24:06',
                'updated_at' => '2025-07-03 08:10:06',
                'stok' => 5,
            ],
            [
                'id' => 4,
                'nama' => 'Sate Lilit',
                'deskripsi' => 'Sate Lilit adalah sate khas Bali yang dibuat dari daging cincang (biasanya ikan, ayam, atau babi) yang dibumbui rempah Bali lengkap, lalu dililitkan pada batang serai atau tusuk bambu, kemudian dibakar hingga harum menggoda.',
                'harga' => 35000,
                'gambar' => '1751555692_satelilit.jpg',
                'created_at' => '2025-04-13 04:24:06',
                'updated_at' => '2025-07-04 01:53:53',
                'stok' => 9,
            ],
            [
                'id' => 14,
                'nama' => 'Nasi Campur Bali',
                'deskripsi' => 'Satu porsi Nasi Campur Bali berisi nasi putih pulen yang disajikan dengan lauk khas Bali: ayam betutu, sate lilit, lawar, sambal matah, urap sayur, dan kerupuk renyah. Semua bumbu diracik dengan rempah pilihan, menghadirkan rasa pedas gurih yang bikin lidah bergoyang!',
                'harga' => 15000,
                'gambar' => '1751549261_nasi_campur_bali.jpg',
                'created_at' => '2025-07-03 06:27:41',
                'updated_at' => '2025-07-04 02:10:41',
                'stok' => 16,
            ],
            [
                'id' => 15,
                'nama' => 'Jukut ares',
                'deskripsi' => 'Nikmati kelezatan khas Bali dengan Jukut Ares, sayur unik berbahan batang pisang muda (ares) yang dimasak dengan bumbu rempah pilihan. Rasanya gurih, segar, dan harum rempah Bali yang khas membuat setiap suapan bikin nagih!',
                'harga' => 60000,
                'gambar' => '1751553886_jukut_ares.jpg',
                'created_at' => '2025-07-03 07:44:46',
                'updated_at' => '2025-07-03 07:44:46',
                'stok' => 20,
            ],
            [
                'id' => 16,
                'nama' => 'Tum ayam',
                'deskripsi' => 'Tum Ayam adalah sajian tradisional Bali berupa daging ayam cincang yang dibumbui rempah genep khas Bali, dibungkus daun pisang, lalu dikukus hingga harum. Rasanya gurih, pedas, dan wangi daun pisang yang menambah kelezatan.',
                'harga' => 15000,
                'gambar' => '1751554275_tum_ayam.jpg',
                'created_at' => '2025-07-03 07:51:15',
                'updated_at' => '2025-07-03 07:51:15',
                'stok' => 20,
            ],
            [
                'id' => 17,
                'nama' => 'Pai susu',
                'deskripsi' => 'Pai Susu Bali terkenal dengan kulitnya yang tipis renyah dan isian susu manis legit. Cocok untuk camilan teman kopi, teh, atau oleh-oleh khas Bali.',
                'harga' => 35000,
                'gambar' => '1751554649_paisusu.jpg',
                'created_at' => '2025-07-03 07:57:29',
                'updated_at' => '2025-07-04 02:10:41',
                'stok' => 19,
            ],
            [
                'id' => 18,
                'nama' => 'Lawar bali',
                'deskripsi' => 'Lawar adalah campuran sayuran, kelapa parut, dan daging cincang yang dibumbui rempah khas Bali. Rasanya gurih, pedas, dan harum bumbu Bali. Biasanya disajikan sebagai lauk pendamping nasi campur atau babi guling.',
                'harga' => 10000,
                'gambar' => '1751555014_lawar.jpg',
                'created_at' => '2025-07-03 08:03:34',
                'updated_at' => '2025-07-04 02:10:41',
                'stok' => 19,
            ],
        ]);
    }
}
