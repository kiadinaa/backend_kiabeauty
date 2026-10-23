<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Halaman Utama & Katalog
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/produk', [PageController::class, 'products'])->name('shop.index');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

// Detail Produk (Mendukung /produk/{slug} dan /product/{slug})
Route::get('/produk/{slug}', [ShopController::class, 'show'])->name('shop.detail');
Route::get('/product/{slug}', [ShopController::class, 'show']);

// Keranjang Belanja (Mendukung /keranjang dan /cart)
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart', [CartController::class, 'index']);
Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('cart.add');
Route::patch('/keranjang/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/keranjang/kosongkan', [CartController::class, 'clear'])->name('cart.clear');

// Checkout & Pemesanan
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Daftar Belanja (Riwayat Pesanan #kayashopeeversisederhana)
Route::get('/daftar-belanja', [OrderController::class, 'index'])->name('orders.index');
Route::get('/daftar-belanja/{order_number}', [OrderController::class, 'show'])->name('orders.show');

// Rating & Ulasan Produk
Route::post('/ulasan', [ReviewController::class, 'store'])->name('reviews.store');

// Autentikasi User
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
