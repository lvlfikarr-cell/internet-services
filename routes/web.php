<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// Auth Routes - PERBAIKI METHOD YANG SALAH
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']); // PASTIKAN METHOD login() ADA

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']); // PASTIKAN METHOD register() ADA

Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // GUNAKAN CONTROLLER

// Jenis Layanan Routes
Route::resource('jenis-layanan', JenisLayananController::class);

// Transaksi Routes
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat.index');
Route::get('/transaksi/create/{layanan}', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::get('/transaksi/berlangganan/{layanan}', [TransaksiController::class, 'create'])->name('transaksi.berlangganan');
Route::resource('transaksi', TransaksiController::class);