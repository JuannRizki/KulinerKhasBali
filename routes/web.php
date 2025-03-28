<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CostumerController; // Pastikan nama ini benar
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LocationController;

Route::get('/location', [LocationController::class, 'index']);


Route::get('/about', [AboutController::class, 'index']);


// Route untuk halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk menampilkan daftar barang
Route::get('/list-barang', [ListBarangController::class, 'tampilkan'])->name('list.barang');

// Route untuk menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');

// Route untuk produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

// Route untuk customer
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');

// Route untuk costumer (Pastikan ini memang diperlukan dan bukan duplikat dari customer)

Route::get('/costumer', [CostumerController::class, 'index'])->name('costumer.index');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/kontak', [ContactController::class, 'showContactForm'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'submitContact'])->name('contact.submit');