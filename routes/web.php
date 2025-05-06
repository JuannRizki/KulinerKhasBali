<?php

use App\Http\Controllers\{
    Auth\AuthenticatedSessionController,
    ProfileController,
    HomeController,
    DashboardController,
    PesananController,
    KontakController,
    AdminDashboardController,
    MenuController,
    UserController,
    OrderController
};
use Illuminate\Support\Facades\Route;

// 🏠 Halaman utama (tanpa login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu-terbaik', [MenuController::class, 'terbaik'])->name('menu.terbaik');

// 🔐 Login dan Logout
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// 🔁 Redirect setelah login berdasarkan role
Route::get('/redirect', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');
})->middleware('auth');

// 🛡️ Route yang butuh login
Route::middleware(['auth'])->group(function () {

    // 👤 Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📊 Dashboard user
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    // 🍽️ Pesanan (user)
    Route::resource('pesanan', PesananController::class)->except(['create', 'edit']);
    Route::put('/pesanan/{id}/pembayaran', [PesananController::class, 'updatePembayaran'])->name('pesanan.pembayaran');
    Route::put('/pesanan/{id}/rating', [PesananController::class, 'updateRating'])->name('pesanan.updateRating');
    Route::delete('/pesanan/{id}/batal', [PesananController::class, 'batal'])->name('pesanan.batal');
    Route::get('/pembayaran', [PesananController::class, 'pembayaran'])->name('pembayaran.index');
    Route::get('/pembayaran/{id}/detail', [PesananController::class, 'detailStruk'])->name('pembayaran.detail');

    // 💬 Kontak (user)
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

    // 🛠️ Dashboard Admin
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // 📬 Pesan Kontak (admin)
    Route::get('/admin/pesan-kontak', [KontakController::class, 'lihatPesan'])->name('admin.pesanKontak');
    Route::delete('/admin/pesan-kontak/{id}', [KontakController::class, 'hapusPesan'])->name('admin.hapusPesan');

    // 👥 User Management (admin)
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // 🧾 Order Management (admin)
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
    Route::post('/admin/orders', [OrderController::class, 'store'])->name('admin.orders.store');
    Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // 🍽️ Menu Management (admin)
    Route::get('/admin/menus', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/admin/menus/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/admin/menus', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/admin/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/admin/menus/{menu}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/admin/menus/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
});

// Tambahan dari Breeze atau Jetstream jika dipakai
require __DIR__.'/auth.php';
