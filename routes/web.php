<?php

use Illuminate\Support\Facades\Route;
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
    OrderController,
    CartController,
    RekapController
};

// ==========================
// 🔓 Halaman Umum
// ==========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu-terbaik', [MenuController::class, 'terbaik'])->name('menu.terbaik');

// ==========================
// 🔐 Autentikasi
// ==========================
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Redirect user sesuai role
Route::get('/redirect', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');
})->middleware('auth');

// ==========================
// 🔒 Hanya untuk user login
// ==========================
Route::middleware(['auth'])->group(function () {
    // 👤 Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');

    // 📊 Dashboard User
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    // 🛒 Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    Route::post('/keranjang/tambah', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/keranjang/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/keranjang/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // 🧾 Pesanan & Pembayaran
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/{id}/bayar', [PesananController::class, 'bayar'])->name('pesanan.bayar');
    Route::post('/pesanan/{id}/bayar-manual', [PesananController::class, 'bayarManual'])->name('pesanan.bayarManual');
    Route::post('/pesanan/{id}/upload', [PesananController::class, 'updatePembayaran'])->name('pesanan.upload');
    Route::post('/pesanan/{id}/rating', [PesananController::class, 'updateRating'])->name('pesanan.rating');
    Route::post('/pesanan/{id}/batal', [PesananController::class, 'batal'])->name('pesanan.batal');
    Route::get('/pesanan/{id}/detail', [PesananController::class, 'detailStruk'])->name('pesanan.detail');
    Route::get('/pesanan/{pesanan}/invoice', [PesananController::class, 'invoice'])->name('pesanan.invoice');
    Route::get('/pesanan/{id}/struk', [PesananController::class, 'cetakStruk'])->name('pesanan.cetakStruk');
    Route::get('/pesanan/history', [PesananController::class, 'history'])->name('orders.history');
    Route::post('/pesanan/{id}/mark-paid', [PesananController::class, 'markPaid'])->name('pesanan.markPaid');

    // 💬 Kontak
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

    // 🍽️ Menu (untuk user)
    Route::get('/user/menus', [MenuController::class, 'userIndex'])->name('user.menu.index');
    Route::get('/menus', [MenuController::class, 'userIndex'])->name('user.menus.index');
    // 🔍 Pencarian Menu
    Route::get('/menu/search', [MenuController::class, 'userIndex'])->name('menu.search');

    // ==========================
    // 👑 ADMIN AREA
    // ==========================
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/contacts', [KontakController::class, 'lihatPesan'])->name('contacts');
        Route::delete('/contacts/{id}', [KontakController::class, 'hapusPesan'])->name('hapusPesan');
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::put('/orders/{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
        Route::put('/orders/{order}/mark-paid', [OrderController::class, 'markAsPaid'])->name('orders.markPaid');
        Route::put('/orders/{order}/deliver', [OrderController::class, 'kirim'])->name('orders.deliver');
        Route::put('/orders/{order}/mark-delivered', [OrderController::class, 'markAsDelivered'])->name('orders.markDelivered');
        Route::get('/menus', [MenuController::class, 'index'])->name('menu.index');
        Route::get('/menus/create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('/menus', [MenuController::class, 'store'])->name('menu.store');
        Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
        Route::get('/rekap-penjualan', [RekapController::class, 'index'])->name('rekap.index');
    });
});

// ==========================
// ✅ Midtrans Callback TANPA auth
// ==========================
Route::post('/midtrans/callback', [PesananController::class, 'callback']);

// Auth Laravel Breeze / Fortify
require __DIR__.'/auth.php';

// Alias agar route('menu.index') tetap bisa dipakai di luar admin
Route::get('/admin-menus', [MenuController::class, 'index'])->name('menu.index');
// Alias agar route('menu.create') tetap bisa dipakai di luar admin
Route::get('/admin-menus/create', [MenuController::class, 'create'])->name('menu.create');
// Alias agar route('menu.edit') tetap bisa dipakai di luar admin
Route::get('/admin-menus/{menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
// Alias agar route('menu.destroy') tetap bisa dipakai di luar admin
Route::delete('/admin-menus/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');

// Alias agar route('admin.menu.create') tetap bisa dipakai
Route::get('/admin-menus/create', [MenuController::class, 'create'])->name('admin.menu.create');
// Alias agar route('admin.menu.edit') tetap bisa dipakai
Route::get('/admin-menus/{menu}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
// Alias agar route('admin.menu.destroy') tetap bisa dipakai
Route::delete('/admin-menus/{menu}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
