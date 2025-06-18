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
    CartController
};

// 🔓 Halaman Umum
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu-terbaik', [MenuController::class, 'terbaik'])->name('menu.terbaik');

// 🔐 Autentikasi
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// 🔁 Redirect setelah login berdasarkan role
Route::get('/redirect', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('dashboard');
})->middleware('auth');

// 🔒 Semua route ini hanya untuk user yang sudah login
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
    Route::post('/pesanan/{id}/upload', [PesananController::class, 'updatePembayaran'])->name('pesanan.upload');
    Route::post('/pesanan/{id}/rating', [PesananController::class, 'updateRating'])->name('pesanan.rating');
    Route::post('/pesanan/{id}/batal', [PesananController::class, 'batal'])->name('pesanan.batal');
    Route::get('/pesanan/{id}/detail', [PesananController::class, 'detailStruk'])->name('pesanan.detail');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::get('/pesanan/{pesanan}/invoice', [PesananController::class, 'invoice'])->name('pesanan.invoice');
    Route::get('/pesanan/{id}/struk', [PesananController::class, 'cetakStruk'])->name('pesanan.cetakStruk');


    // 📜 Riwayat Pesanan
    Route::get('/history', [OrderController::class, 'history'])->name('orders.history');
    Route::delete('/history/{id}', [OrderController::class, 'destroyUserOrder'])->name('orders.history.destroy');

    // 💬 Kontak
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

    // 🍽️ Menu (untuk user)
    Route::get('/user/menus', [MenuController::class, 'userIndex'])->name('user.menu.index');

    // ==========================
    // 👑 ADMIN AREA
    // ==========================
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // 💬 Kontak (admin)
    Route::get('/admin/contacts', [KontakController::class, 'lihatPesan'])->name('admin.contacts');
    Route::delete('/admin/contacts/{id}', [KontakController::class, 'hapusPesan'])->name('admin.hapusPesan');

    // 👥 User (admin)
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // 📦 Pesanan (admin)
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/admin/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
    Route::post('/admin/orders', [OrderController::class, 'store'])->name('admin.orders.store');
    Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/admin/orders/{order}', [OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/admin/orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');

    // ✅ Tambahan aksi manual untuk admin
    Route::put('/admin/orders/{order}/approve', [OrderController::class, 'approve'])->name('admin.orders.approve');
    Route::put('/admin/orders/{order}/mark-paid', [OrderController::class, 'markAsPaid'])->name('admin.orders.markPaid');
    Route::put('/admin/orders/{order}/deliver', [OrderController::class, 'kirim'])->name('admin.orders.deliver');
    Route::put('/admin/orders/{order}/mark-delivered', [OrderController::class, 'markAsDelivered'])->name('admin.orders.markDelivered');

    // 🍽️ Menu (admin)
    Route::get('/admin/menus', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/admin/menus/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/admin/menus', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/admin/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/admin/menus/{menu}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/admin/menus/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
});

// ✅ Midtrans Callback (tidak perlu login)
Route::post('/midtrans/callback', [PesananController::class, 'callback']);

// 🔁 Auth (Laravel Breeze / Fortify)
require __DIR__.'/auth.php';
