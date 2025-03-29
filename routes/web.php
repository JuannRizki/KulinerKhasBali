<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CostumerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;




// Route lokasi
Route::get('/location', [LocationController::class, 'index']);

// Route about
Route::get('/about', [AboutController::class, 'index']);

// Route halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route daftar barang
Route::get('/list-barang', [ListBarangController::class, 'tampilkan'])->name('list.barang');

// Route menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');

// Route produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');

// Route customer
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');

// Route costumer (jika memang diperlukan)
Route::get('/costumer', [CostumerController::class, 'index'])->name('costumer.index');

// Route login & logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route kontak
Route::get('/kontak', [ContactController::class, 'showContactForm'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'submitContact'])->name('contact.submit');

// Route admin
Route::get('/admin/login', [LoginAdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [LoginAdminController::class, 'login']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
