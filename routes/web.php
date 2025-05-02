<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontakController;
<<<<<<< HEAD
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

// 🔁 Redirect otomatis setelah login berdasarkan role
Route::get('/redirect', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('dashboard');
});

// 🏠 Halaman utama (tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔐 Login dan logout
=======
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Rute untuk halaman utama (tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute login dan logout
>>>>>>> f1eb59171ad931d734f3ee2a2f0898af39f106b2
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

<<<<<<< HEAD
// 🔐 Group route untuk user yang login
Route::middleware('auth')->group(function () {
    // 👤 Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📊 Dashboard user
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    // 🍽️ Pesanan
    Route::resource('pesanan', PesananController::class);
    Route::put('/pesanan/{id}/pembayaran', [PesananController::class, 'updatePembayaran'])->name('pesanan.pembayaran');
    Route::put('/pesanan/{id}/rating', [PesananController::class, 'updateRating'])->name('pesanan.updateRating');
    Route::delete('/pesanan/{id}/batal', [PesananController::class, 'batal'])->name('pesanan.batal');
    Route::get('/pembayaran', [PesananController::class, 'pembayaran'])->name('pembayaran.index');
    Route::get('/pembayaran/{id}/detail', [PesananController::class, 'detailStruk'])->name('pembayaran.detail');

    // 📨 Pesan kontak (khusus admin)
    Route::get('/admin/pesan-kontak', [KontakController::class, 'lihatPesan'])->name('admin.pesanKontak');
    Route::delete('/admin/pesan-kontak/{id}', [KontakController::class, 'hapusPesan'])->name('admin.hapusPesan');

    // 💬 Kontak user
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
});

// Auth route default Laravel
=======
// Group route untuk autentikasi dan profil pengguna
Route::middleware('auth')->group(function () {
    // Rute untuk halaman profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rute untuk dashboard pengguna yang sudah terverifikasi
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    // Rute untuk CRUD pesanan (menggunakan resource controller)
    Route::resource('pesanan', PesananController::class);

    // Rute untuk pembayaran dan rating pada pesanan
    Route::put('/pesanan/{id}/pembayaran', [PesananController::class, 'updatePembayaran'])->name('pesanan.pembayaran');
    Route::put('/pesanan/{id}/rating', [PesananController::class, 'updateRating'])->name('pesanan.updateRating');
    
    // Rute untuk membatalkan pesanan
    Route::delete('/pesanan/{id}/batal', [PesananController::class, 'batal'])->name('pesanan.batal');
    
    // Rute untuk menampilkan pesanan yang sudah dibayar
    Route::get('/pembayaran', [PesananController::class, 'pembayaran'])->name('pembayaran.index');

    // Rute untuk menampilkan detail struk pembayaran
    Route::get('/pembayaran/{id}/detail', [PesananController::class, 'detailStruk'])->name('pembayaran.detail');

    // Rute untuk melihat pesan kontak di admin
    Route::get('/admin/pesan-kontak', [KontakController::class, 'lihatPesan'])->name('admin.pesanKontak');

    // Rute untuk menghapus pesan kontak di admin
    Route::delete('/admin/pesan-kontak/{id}', [KontakController::class, 'hapusPesan'])->name('admin.hapusPesan');
});

// Rute untuk kontak (hanya untuk pengguna yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
});

// Auth route untuk menangani autentikasi
>>>>>>> f1eb59171ad931d734f3ee2a2f0898af39f106b2
require __DIR__.'/auth.php';
