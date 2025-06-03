<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KeranjangController;

Route::get('/', [WelcomeController::class, 'index'])->name('beranda');
Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('produk.detail');

//auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard untuk user role saja
// Route::middleware(['auth', 'role:user'])->get('/', function () {
//     return view('beranda');
// })->name('beranda');
// Routes untuk keranjang (memerlukan autentikasi)
Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{produk}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::put('/keranjang/update/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');
    Route::delete('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])->name('keranjang.kosongkan');
    // Route untuk mendapatkan jumlah item keranjang (untuk navbar)
    Route::get('/keranjang/count', [KeranjangController::class, 'getCount'])->name('keranjang.count');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/checkout/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');
    Route::post('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    //riwayat
    Route::get('/riwayat-transaksi', [RiwayatController::class, 'index'])->name('riwayat.index');
});







