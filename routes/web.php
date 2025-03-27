<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group that
| contains the "web" middleware group. Now create something great!
|
*/

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk menampilkan daftar barang
Route::get('/list-barang', [ListBarangController::class, 'tampilkan']);
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/customer', [CustomerController::class, 'index']);
