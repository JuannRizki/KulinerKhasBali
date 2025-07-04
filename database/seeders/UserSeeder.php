<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 3,
                'name' => 'rayenn',
                'email' => 'rian83600@gmail.com',
                'alamat' => 'baloi',
                'email_verified_at' => null,
                'password' => '$2y$12$Lb1GW0.2vBkRyQURRYlPkOVcahQ/2OmiYuk5lUu8yiIrR6PMob29u',
                'remember_token' => null,
                'created_at' => '2025-04-13 12:35:39',
                'updated_at' => '2025-05-21 06:49:53',
                'role' => 'user',
                'profile_picture' => '',
            ],
            [
                'id' => 5,
                'name' => 'juann',
                'email' => 'juan@gmail.com',
                'alamat' => null,
                'email_verified_at' => null,
                'password' => '$2y$12$EHyrrmJgQxDdm6OLthRYReBmkpxpnVSIoCkL6Jikcn5UJkWmgisSa',
                'remember_token' => null,
                'created_at' => '2025-04-16 04:25:44',
                'updated_at' => '2025-04-16 04:25:44',
                'role' => 'user',
                'profile_picture' => null,
            ],
            [
                'id' => 6,
                'name' => 'gofur',
                'email' => 'gofur@gmail.com',
                'alamat' => null,
                'email_verified_at' => null,
                'password' => '$2y$12$8wdIEaHTK7JzglpjNlttaeKxFxP2NkJ2g6YnpssZQ954Dl8UE6SWm',
                'remember_token' => null,
                'created_at' => '2025-04-29 04:58:39',
                'updated_at' => '2025-04-29 04:58:39',
                'role' => 'user',
                'profile_picture' => null,
            ],
            [
                'id' => 13,
                'name' => 'riansyah',
                'email' => 'riansyah@gmail.com',
                'alamat' => 'Baloi Center jalan melati',
                'email_verified_at' => null,
                'password' => '$2y$12$aFWX.cd89okC4B9sIFPQdeI.YJDHZChof9GTKC6XqFbmImMnsPnv6',
                'remember_token' => 'ydiWPEVGqfgN0kLFAxdQzlCfWjYBfyNOPM6sYg2BoLMnRnEAmqMfgtaap0WN',
                'created_at' => '2025-06-02 04:53:07',
                'updated_at' => '2025-06-03 07:12:51',
                'role' => 'user',
                'profile_picture' => null,
            ],
            [
                'id' => 14,
                'name' => 'ADMIN',
                'email' => 'admin@gmail.com',
                'alamat' => null,
                'email_verified_at' => null,
                'password' => '$2y$12$K1PC/13UhGsT.G.y3bwX9eeIszooAdFpSOm6.shp7v.av1sORoTYK',
                'remember_token' => null,
                'created_at' => '2025-06-02 04:54:37',
                'updated_at' => '2025-06-02 04:54:37',
                'role' => 'admin',
                'profile_picture' => null,
            ],
            [
                'id' => 16,
                'name' => 'juan',
                'email' => 'juann@gmail.com',
                'alamat' => 'Bengkong',
                'email_verified_at' => null,
                'password' => '$2y$12$BiD3vPFVzY8Qpv2I/VAmBO4T5welLwqAtfFvoXuICxmvhSCoYfyea',
                'remember_token' => null,
                'created_at' => '2025-06-03 08:02:23',
                'updated_at' => '2025-06-03 08:02:46',
                'role' => 'user',
                'profile_picture' => null,
            ],
            [
                'id' => 17,
                'name' => 'riansyahss',
                'email' => 'rian836ss00@gmail.com',
                'alamat' => 'Batu aji',
                'email_verified_at' => null,
                'password' => '$2y$12$i8WW9IYUPSZUVy9KN63D9uW9AIey9yp/aPtRBgI4bHKpkr/8XeB3K',
                'remember_token' => null,
                'created_at' => '2025-06-03 08:32:40',
                'updated_at' => '2025-06-03 08:34:31',
                'role' => 'user',
                'profile_picture' => null,
            ],
            [
                'id' => 18,
                'name' => 'demo',
                'email' => 'demo@gmail.com',
                'alamat' => null,
                'email_verified_at' => null,
                'password' => '$2y$12$gpYsT6AYvi4FvswyDKaAMOQ8KXG7LL5ElzLKbkHyUXIGTMuTcg8DS',
                'remember_token' => null,
                'created_at' => '2025-07-04 01:46:39',
                'updated_at' => '2025-07-04 01:46:39',
                'role' => 'user',
                'profile_picture' => null,
            ],
        ]);
    }
}
